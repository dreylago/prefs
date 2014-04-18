<?php

namespace Prefs\DB;

use Prefs\System\LocalFileSystem;

/**
 * Description of File
 *
 * @author drey
 */
class FileSystem {
	//put your code here
	public $path;
	public $system;

	function __construct($path, $system=NULL) {
		$this->path = $path;
		if ($storage=NULL) {
			$this->system = new LocalFileSystem();
		}
	}
	function sanitizeFn($str) {
		$fn = preg_replace("/[^a-zA-Z0-9_-]+/i", "_", $str);
		return $fn;
	}
	function _loadUserPrefs($username) {
		$fn = $this->sanitizeFn($username) . '.json';
		if ($this->system->file_exists("$this->path/$fn") && is_readable("$this->path/$fn")) {
			$user_prefs = json_decode($this->system->file_get_contents("$this->path/$fn"),true);
			return $user_prefs;
		}
		return false;
	}
	function _saveUserPrefs($user_prefs,$username) {
		$fn = $this->sanitizeFn($username) . '.json';
		$this->system->file_put_contents("$this->path/$fn", json_encode($user_prefs));
	}
	function get($name, $username) {
		$user_prefs = $this->_loadUserPrefs($username);
		if ($user_prefs) {
			if (isset($user_prefs[$name])) {
				return (object) array('value'=>$user_prefs[$name]);
			}
		}
		return false;
	}
	function getAll($username) {
		$all = $this->_loadUserPrefs($username);
		return $all;
	}
	function set($name, $value, $username) {
		$user_prefs = $this->_loadUserPrefs($username);
		if (!$user_prefs) {
			$user_prefs = array();
		}
		$user_prefs[$name] = $value;
		$this->_saveUserPrefs($user_prefs, $username);
	}
	function delete($name, $username) {
		$user_prefs = $this->_loadUserPrefs($username);
		if (!$user_prefs) {
			$user_prefs = array();
		}
		unset($user_prefs[$name]);
		$this->_saveUserPrefs($user_prefs, $username);
	}
	
	function deleteAll($username) {
		$user_prefs = array();
		$this->_saveUserPrefs($user_prefs, $username);
	}
}
