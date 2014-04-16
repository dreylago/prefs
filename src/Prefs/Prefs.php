<?php

namespace Prefs;
use PrefsBridge\FwBridge;


class Prefs {
	public function __construct($storage) {
		$this->storage = $storage;
	}
	function get($name, $default='', $username=NULL ) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$row = $this->storage->get($name, $username);
		if ($row===false) {
			return $default;
		}
		return $row->value;
	}
	function set($name, $value, $username=NULL) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$this->storage->set($name, $value, $username);
	}
	function getAll($username=NULL) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$all = $this->storage->getAll($username);
		return $all;
	}
	function delete($name, $username=NULL) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$this->storage->delete($name, $username);
	}
	function deleteAll($username=NULL) {
		if (!isset($username)) {
			$username = FwBridge::userid();
		}
		$this->storage->deleteAll($username);
	}
}

