<?php require_once("lib/init.php");

$file = File::get();
if(!$file) {
	header("HTTP/1.1 404 Not Found");
	echo "<h1>404 Not Found</h1>";
	exit;
}

header("Content-Type: $file->mimetype");
header("Content-Length: $file->size");
header("Content-Disposition: inline; filename=$file->filename");
readfile("upload/$file->id");