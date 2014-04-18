<?php

namespace Prefs\DB;
use PrefsBridge\FwBridge;


/**
 * Description of MySQL
 *
 * @author drey
 */


class MySQL {
	public $table;
	function __construct($table='prefs') {
		$this->table = $table;
	}
	function get($name,$username) {
		$q = "select value from `$this->table` where `name`=:name and `username`=:username";
		$row = FwBridge::sqlFindRow($q, array(':name'=>$name, ':username'=>$username));
		return $row;
	}
	
	function getAll($username) {
		$q = "select name, value from `$this->table` where `username`=:username";
		$rows = FwBridge::sqlFindAll($q, array(':username'=>$username));
		$all = array();
		foreach ($rows as $r) {
			$all[$r->name] = $r->value; 
		}
		return $all;
	}
	
	function set($name, $value, $username) {
		$q = "select value from `$this->table` where `name`=:name and `username`=:username";
		$row = FwBridge::sqlFindRow($q, array(':name'=>$name, ':username'=>$username));
		$params = array(':name'=>$name, ':value'=>$value, ':username'=>$username);
		if ($row===false) {
			$q = "insert into `$this->table` (`name`,`value`,`username`) values (:name,:value,:username)";
			FwBridge::sqlExecute($q,$params);
		} else {
			$q = "update `$this->table` set `value`=:value where `name`=:name and `username`=:username";
			FwBridge::sqlExecute($q,$params);
		}
	}
	
	function delete($name, $username) {
		$q = "delete from `$this->table` where `name`=:name and `username`=:username";
		FwBridge::sqlExecute($q, array(':name'=>$name, ':username'=>$username));
	}
	
	function deleteAll($username) {
		$q = "delete from `$this->table` where `username`=:username";
		FwBridge::sqlExecute($q, array(':username'=>$username));
	}
	
}

?>
