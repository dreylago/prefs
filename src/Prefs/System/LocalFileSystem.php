<?php

namespace drey\Prefs\System;


class LocalFileSystem implements FileSystemHandler {
	
	function is_readable($fn) {
		return \is_readable($fn);
	}
	function file_get_contents($fn) {
		clearstatcache();
		$size = filesize($fn);
		$fh = fopen("$fn", "r");
		if (flock($fh, LOCK_SH)) {
#			echo "read $size bytes ...\n";
			$data = fread($fh, $size);
			fflush($fh);          
    		flock($fh, LOCK_UN); 
			fclose($fh);
			return $data;
		} else {
			throw new Exception("could not get shared lock for $fn", 1);
		}
		return '';
	}
	function file_put_contents($fn, $data) {
		$fh = fopen("$fn", "w");
		if (flock($fh, LOCK_EX)) {
			$count = fwrite($fh,$data);
			fflush($fh);          
    		flock($fh, LOCK_UN); 
			fclose($fh);
			return $count;
		} else {
			throw new Exception("could not get exclusive lock for $fn", 1);
		}
		return 0;
	}
} 

?>