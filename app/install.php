<?php
	if(file_exists("config.php")) {
		exit;
	}
	
	if(isset($_POST['_flag'])) {
		if(empty($_POST['login']['user']) || empty($_POST['login']['user'])) {
			$login_error = true;
		}
		if(!@date_default_timezone_set($_POST['timezone'])) {
			$timezone_error = true;
		}
		$host = $_POST['db']['host'];
		$name = $_POST['db']['name'];
		$_POST['db']['dsn'] = "mysql:host=$host;dbname=$name";
		try {
			if(empty($_POST['db']['name'])) {
				$db_error = true;
			} else {
				$pdo = new PDO($_POST['db']['dsn'], $_POST["db"]["user"], $_POST["db"]["pass"]);
			
				// all looks swell here!
				if(!isset($login_error) && !isset($timezone_error)) {
					file_put_contents("config.php", '<?php $config = ' . var_export($_POST, true) . ';');
					
					$sql = <<<SQL
						# Dump of table file
						# ------------------------------------------------------------

						DROP TABLE IF EXISTS `file`;

						CREATE TABLE `file` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `filename` varchar(255) NOT NULL,
						  `mimetype` varchar(255) NOT NULL,
						  `size` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;



						# Dump of table report
						# ------------------------------------------------------------

						DROP TABLE IF EXISTS `report`;

						CREATE TABLE `report` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `created_at` int(11) DEFAULT NULL,
						  `updated_at` int(11) DEFAULT NULL,
						  `street_address` varchar(255) DEFAULT NULL,
						  `city` varchar(255) DEFAULT NULL,
						  `postcode` varchar(10) DEFAULT NULL,
						  `client_name` varchar(255) DEFAULT NULL,
						  `contents` varchar(255) DEFAULT NULL,
						  PRIMARY KEY (`id`),
						  KEY `created_at` (`created_at`),
						  KEY `updated_at` (`updated_at`)
						) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;



						# Dump of table report_contents
						# ------------------------------------------------------------

						DROP TABLE IF EXISTS `report_contents`;

						CREATE TABLE `report_contents` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `report_id` int(11) DEFAULT NULL,
						  `type` int(11) DEFAULT NULL,
						  `data` text,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
SQL;
					$pdo->query($sql);
					
					header("Location: index.php");
					exit;
				}
			}
		} catch(Exception $ex) {
			$db_error = true;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Report Generator Installation</title>
		<link rel="stylesheet" href="style/style.css" type="text/css" media="all" />
	</head>
	<body>
		<div id="wrap_login">
			<div id="header">
				<h1>Report Generator Installation</h1>
			</div>
			<div id="login_area">
				<form name="install" method="post">
					<input type="hidden" name="_flag" value="true" />
					
					<?php if(isset($db_error)): ?>		
						<div class="error" style="background:rgb(255, 192, 192); padding:8px; margin-bottom:12px;">
							Could not connect to MySQL server with the provided details
						</div>
					<?php endif; ?>
						
					<label>MySQL Host:</label>
					<input name="db[host]" type="text" value="<?php echo isset($_POST['db']['host']) ? htmlspecialchars($_POST['db']['host']) : 'localhost'; ?>" />
					<br />
					<label>MySQL Port:</label>
					<input name="db[port]" type="text" value="<?php echo isset($_POST['db']['port']) ? htmlspecialchars($_POST['db']['port']) : '3306'; ?>" />
					<br />
					<label>MySQL Database Name:</label>
					<input name="db[name]" type="text" value="<?php echo isset($_POST['db']['name']) ? htmlspecialchars($_POST['db']['name']) : ''; ?>" />
					<br />
					<label>MySQL Username:</label>
					<input name="db[user]" type="text" value="<?php echo isset($_POST['db']['user']) ? htmlspecialchars($_POST['db']['user']) : ''; ?>" />
					<br />
					<label>MySQL Password:</label>
					<input name="db[pass]" type="password" value="<?php echo isset($_POST['db']['pass']) ? htmlspecialchars($_POST['db']['pass']) : ''; ?>" />
					<br />
					<hr />
					<br />
					<?php if(isset($login_error)): ?>		
						<div class="error" style="background:rgb(255, 192, 192); padding:8px; margin-bottom:12px;">
							Please enter a valid username and password
						</div>
					<?php endif; ?>
					<label>Login Username:</label>
					<input name="login[user]" type="text" value="<?php echo isset($_POST['login']['user']) ? htmlspecialchars($_POST['login']['user']) : ''; ?>" />
					<br />
					<label>Login Password:</label>
					<input name="login[pass]" type="password" value="<?php echo isset($_POST['login']['pass']) ? htmlspecialchars($_POST['login']['pass']) : ''; ?>" />
					<br />
					<hr />
					<br />
					<?php if(isset($timezone_error)): ?>		
						<div class="error" style="background:rgb(255, 192, 192); padding:8px; margin-bottom:12px;">
							Please select a valid timezone
						</div>
					<?php endif; ?>
					<label>Timezone:</label>
					<select name="timezone" style="width:438px">
						<option>-</option>
						<?php foreach(DateTimeZone::listIdentifiers() as $tz): ?>
							<option <?php if(isset($_POST['timezone']) && $_POST['timezone'] == $tz) { echo "selected"; } ?>><?php echo $tz; ?></option>
						<?php endforeach; ?>
					</select>
					<br />
					<br />
					<input id="submit" type="submit" value="next &gt;" />
					<div class="clearfix"></div>
				</form>
			</div>
			<div id="footer">
				<p>Designed &amp; Developed by <a href="http://jacobhaslehurst.com">Jacob Haslehurst</a> &amp; <a href="http://charliesomerville.com">Charlie Somerville</a>. &copy; 2011</p>
			</div>
		</div>
	</body>
</html>