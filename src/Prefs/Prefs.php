<?php

namespace drey\Prefs;
use drey\Prefs\DB\PrefsDB;


/**
 * Object the handles user preferences
 */
class Prefs {
	public $db;
	public $username;

	/**
	 * Initializes user preferences object
	 * @param PrefsDB $db handles the storage and retrieval of
	 * data
	 * @param string  $username
	 */
	public function __construct(PrefsDB $db, $username=NULL) {
		$this->db = $db;
		$this->setDefaultUsername($username);
	}

	/**
	 * Get a user preference
	 * @param  string $name of the preference
	 * @param  string $default value returned if name is not found
	 * @param  string $username
	 * @return string the value
	 */
	function get($name, $default='', $username=NULL ) {
		$row = $this->db->get($name, $this->_getUsername($username));
		if ($row===false) {
			return $default;
		}
		return $row->value;
	}

	/**
	 * Set a user preference
	 * @param string $name of the preference
	 * @param string $value 
	 * @param string $username
	 */
	function set($name, $value, $username=NULL) {
		$this->db->set($name, $value, $this->_getUsername($username));
	}

	/**
	 * Get all preferences of a user
	 * @param  string $username
	 * @return Array of name=>value pairs
	 */
	function getAll($username=NULL) {
		return $this->db->getAll($this->_getUsername($username));
	}

	/**
	 * Delete a user preference
	 * @param  string $name
	 * @param  string $username
	 */
	function delete($name, $username=NULL) {
		$this->db->delete($name, $this->_getUsername($username));
	}

	/**
	 * Delete all preferences of a user
	 * @param  string $username
	 */
	function deleteAll($username=NULL) {
		$this->db->deleteAll($this->_getUsername($username));
	}

	/**
	 * Set the default user for when the set and get calls
	 * ommit the username 
	 * @param string $username
	 */
	function setDefaultUsername($username) {
		$this->username = $username;
	}


	/**
	 * internal function to get the username
	 * if the username has been provided at
	 * function call or return the default username
	 * @param  string $username
	 * @return string the intended username
	 */
	function _getUsername($username=NULL) {
		if (!isset($username)) {
			if (isset($this->username)) {
				return $this->username;
			}
		}
		return $username;
	}
}

