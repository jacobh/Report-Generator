<!DOCTYPE html>
<html>
	<head>
		<title>Report Generator</title>
		<link rel="stylesheet" href="style/style.css" type="text/css" media="all" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	</head>
	<script>
			$(document).ready(function(){
				ColHeight = $(window).height() - 129;
				$("div.col").css("height", ColHeight + "px");
			});
	</script>
	<body>
		<div id="wrap">
			<div id="header">
				<h1>Report Generator</h1>
			</div>
			<div id="main_content">
				<div id="main_content_lhs" class="col">
					<ul id="nav">
						<a href="new_report.php">
							<li>	
								<p>New Report</p>
								<img src="style/images/newreport.png"></img>
							</li>
						</a>
						<a href="index.php">
							<li>
								<p>Reports</p>
								<img src="style/images/reports.png"></img>
							</li>
						</a>
						<a href="clients.php">
							<li>
								<p>Clients</p>
								<img src="style/images/clients.png"></img>
							</li>
						</a>
						<a href="email.php">
							<li>
								<p>Email</p>
								<img src="style/images/email.png"></img>
							</li>
						</a>
						<a href="settings.php">
							<li>
								<p>Settings</p>
								<img src="style/images/settings.png"></img>
							</li>
						</a>
						<a href="logout.php">
							<li>
								<p>Logout</p>
							</li>
						</a>
					</ul>
				</div>
				<?php
				include $__page;				
				?>
			</div>
			<div id="footer">
				<p>Designed &amp; Developed by <a href="http://jacobhaslehurst.com">Jacob Haslehurst</a> &amp; <a href="http://charliesomerville.com">Charlie Somerville</a>. &copy; 2011</p>
		</div>
	</body>
</html>