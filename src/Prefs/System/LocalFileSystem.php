<?php

namespace Prefs\System;

class LocalFileSystem {
	
	function is_readable($fn) {
		return \is_readable($fn);
	}
	function file_get_contents($fn) {
		return \file_get_contents($fn);
	}
	function file_put_contents($fn, $data) {
		return \file_put_contents($fn, $data);
	}
} 

?>