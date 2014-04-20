<?php

namespace drey\Prefs\Test;

use drey\Prefs\DB\FileSystem;

class FileSystemTest extends \PHPUnit_Framework_TestCase {

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
		$db->set('bird','eagle','drey');
		$e_ = $db->_loadUserPrefs('drey');
		$this->assertTrue(is_array($e_));
		$this->assertEquals('eagle',$e_['bird']);
		$row = $db->get('bird','drey');
		$this->assertEquals('eagle',$row->value);
		$row = $db->get('fruit','drey');
		$this->assertEquals('mango',$row->value);
	}



	

}