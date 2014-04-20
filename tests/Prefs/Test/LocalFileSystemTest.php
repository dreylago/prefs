<?php

namespace drey\Prefs\Test;

use drey\Prefs\System\LocalFileSystem;


class LocalFileSystemTest extends \PHPUnit_Framework_TestCase {

	public function testWriteRead() {
		$fn = "/tmp/test.json";
		$lfs = new LocalFileSystem();
		$d = "weruytridgids";
		$lfs->file_put_contents($fn, $d);
		$x = $lfs->is_readable($fn);
		$this->assertTrue($x);
		$d_ = $lfs->file_get_contents($fn);
		$this->assertEquals($d,$d_);
	}

	
	

}
