<?php

namespace drey\Prefs;

use drey\Prefs\Prefs;
use drey\Prefs\DB\FileSystem;
use drey\Prefs\DB\PDOInstance;


/**
 * Retunrs properly initialized Prefs objects
 */
class Factory {

	/**
	 * returns a file system based object
	 * @param  string $path     directory where json file will be located
	 * @param  string $username 
	 * @return object: file system based object
	 */
	static public function fileSystem($path, $username) {
		$db = new FileSystem($path);
    	$prefs = new Prefs($db);
    	$prefs->setDefaultUsername($username);
    	return $prefs;
	}

	/**
	 * returns a pdo based object
	 * @param  object $pdo      pdo object
	 * @param  string $username 
	 * @return object: pdo-based object
	 */
	static public function pdo($pdo, $username) {
    	$db = new PDOInstance($pdo);
    	$prefs = new Prefs($db);
    	$prefs->setDefaultUsername($username);
    	return $prefs;
	}
}

