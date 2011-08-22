<?php require_once("lib/init.php");

RecommendedItem::get()->destroy();
json(array("status" => true));