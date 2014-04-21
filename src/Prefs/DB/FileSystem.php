<?php

namespace drey\Prefs\DB;

use drey\Prefs\System\LocalFileSystem;

/**
 * Description of File
 *
 * @author drey
 */
class FileSystem implements PrefsDB {
	//put your code here
	public $path;
	public $system;

	/**
	 * Initializes a FileSystem PrefsDB object
	 * @param string $path Directory where the data
	 * will be stored
	 * @param FileSystemHandler $system handles calls to
	 * the system
	 */
	function __construct($path, FileSystemHandler $system=NULL) {
		$this->path = $path;
		if ($system==NULL) {
			$this->system = new LocalFileSystem();
		}
	}
	function sanitizeFn($str) {
		$fn = preg_replace("/[^a-zA-Z0-9_-]/i", "_", $str);
		if (!preg_match("/\w{3}/",$fn)) {
			$fn = sha1($str);
		}
		return $fn;
	}
	function _loadUserPrefs($username) {
		$fn = $this->sanitizeFn($username) . '.json';
		if ($this->system->is_readable("$this->path/$fn")) {
			$contents = $this->system->file_get_contents("$this->path/$fn");
			$user_prefs = json_decode($contents,true);
#			echo "load userprefs of $username in $this->path/$fn is\ncontents=$contents\ndata=". print_r($user_prefs,1);
			return $user_prefs;
		}
		return array();
	}
	function _saveUserPrefs($user_prefs, $username) {
		$fn = $this->sanitizeFn($username) . '.json';
#		echo "save userprefs of $username= ". print_r($user_prefs,1);
		$this->system->file_put_contents("$this->path/$fn", json_encode($user_prefs));
	}
	function get($name, $username) {
		$user_prefs = $this->_loadUserPrefs($username);
		if (isset($user_prefs[$name])) {
			return (object) array('value'=>$user_prefs[$name]);
		}
		return false;
	}
	function getAll($username) {
		$all = $this->_loadUserPrefs($username);
		return $all;
	}
	function set($name, $value, $username) {
		$user_prefs = $this->_loadUserPrefs($username);
		$user_prefs[$name] = $value;
		$this->_saveUserPrefs($user_prefs, $username);
	}
	function delete($name, $username) {
		$user_prefs = $this->_loadUserPrefs($username);
		unset($user_prefs[$name]);
		$this->_saveUserPrefs($user_prefs, $username);
	}
	function deleteAll($username) {
		$user_prefs = array();
		$this->_saveUserPrefs($user_prefs, $username);
	}
}
