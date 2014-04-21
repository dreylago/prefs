<?php

namespace drey\Prefs\System;

interface FileSystemHandler {
	
	/**
	 * file is readable
	 * @param  string  $fn Filename
	 * @return boolean 
	 */
	function is_readable($fn);

	/**
	 * Get contents of a file in a concurrent safe manner
	 * @param  string $fn
	 * @return string The contents of the file. Empty if does not
	 * exists
	 */
	function file_get_contents($fn);

	/**
	 * Put data in a file
	 * @param  string $fn Filename
	 * @param  string $data Data to be written 
	 * @return integer Byte count
	 */
	function file_put_contents($fn, $data);
} 

?>