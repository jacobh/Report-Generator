<?php require_once "lib/init.php";

ensure("post");
expects(array( "name" => "string", "description" => "string", "price" => "int" ));
json(RecommendedItem::create($params));