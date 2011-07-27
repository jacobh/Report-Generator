<?php

class File extends ModelBase {
	public static function upload($k) {
		if($_FILES[$k]['error'] !== UPLOAD_ERR_OK) {
			return NULL;
		}
		$f = self::create(array( 'filename' => $_FILES[$k]['name'], 'mimetype' => $_FILES[$k]['type'], 'size' => $_FILES[$k]['size'] ));
		if(!move_uploaded_file($_FILES[$k]['tmp_name'], "upload/$f->id")) {
			$f->destroy();
			print_r($f);
			exit;
			return NULL;
		} else {
			$f->save();
		}
		return $f;
	}
}