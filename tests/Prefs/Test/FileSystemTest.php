<?php

namespace drey\Prefs\Test;

use drey\Prefs\DB\FileSystem;
use drey\Prefs\Test\DBSuite;

class FileSystemTest extends DBSuite {

	public function testWriteRead() {
		if (file_exists('/tmp/drey.json')) {
			unlink('/tmp/drey.json');
		}
		$db = new FileSystem('/tmp');
		$d = array('fruit'=>'mango','color'=>'red',
			'country'=>'Spain');
		$db->_saveUserPrefs($d,'drey');
		$d_ = $db->_loadUserPrefs('drey');
		$this->assertTrue(is_array($d_));
		$this->assertEquals($d,$d_);
		$this->basicTests($db);
	}



	

}