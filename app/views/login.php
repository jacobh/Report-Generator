<!DOCTYPE html>
<html>
	<head>
		<title>Report Generator | Main</title>
		<link rel="stylesheet" href="style/style.css" type="text/css" media="all" />
	</head>
	<body>
		<div id="wrap_login">
			<div id="header">
				<h1>Report Generator</h1>
			</div>
			<div id="login_area">
				<?php if($error): ?>
					<div class="error">
						Incorrect username/password
					</div>
				<?php endif; ?>
				<form name="login" method="post">
					<label>Username</label>
					<input name="user" type="text" />
					<br />
					<label>Password</label>
					<input name="pass" type="password" />
					<input id="submit" type="submit" value="submit" />
					<div class="clearfix"></div>
				</form>
			</div>
			<div id="footer">
				<p>Designed &amp; Developed by <a href="http://jacobhaslehurst.com">Jacob Haslehurst</a> &amp; <a href="http://charliesomerville.com">Charlie Somerville</a>. &copy; 2011</p>
			</div>
		</div>
	</body>
</html>