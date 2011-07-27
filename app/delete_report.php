<?php require_once('lib/init.php');

Report::get()->destroy();
redirect("index.php");