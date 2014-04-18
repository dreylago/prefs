<?php

namespace drey\Prefs;
use drey\Prefs\FwBridge\User as FwBridge;

class Prefs {
	public $db;
	public function __construct($db) {
		$this->db = $db;
	}
	function get($name, $default='', $username=NULL ) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$row = $this->db->get($name, $username);
		if ($row===false) {
			return $default;
		}
		return $row->value;
	}
	function set($name, $value, $username=NULL) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$this->db->set($name, $value, $username);
	}
	function getAll($username=NULL) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$all = $this->db->getAll($username);
		return $all;
	}
	function delete($name, $username=NULL) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$this->db->delete($name, $username);
	}
	function deleteAll($username=NULL) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$this->db->deleteAll($username);
	}
}

