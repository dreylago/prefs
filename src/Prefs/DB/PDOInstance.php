<?php

namespace drey\Prefs\DB;

class PDOInstance implements PrefsDB {
	public $pdo;
	public $table;
	function __construct(\PDO $pdoInstance, $table='prefs') {
		$this->pdo = $pdoInstance;
		$this->table = $table;
	}
	function get($name,$username) {
		$q = "select value from `$this->table` where `name`=:name and `username`=:username";
		$s = $this->pdo->prepare($q);
		$s->bindValue(':name',$name);
		$s->bindValue(':username', $username);
		$s->execute();
		$row = $s->fetch(\PDO::FETCH_OBJ);
		return $row;
	}
	function getAll($username) {
		$q = "select name, value from `$this->table` where `username`=:username";
		$s = $this->pdo->prepare($q);
		$s->bindValue(':username', $username);
		$s->execute();
		return $s->fetchAll();
	}
	function set($name, $value, $username) {
		$q = "select value from `$this->table` where `name`=:name and `username`=:username";
		$s = $this->pdo->prepare($q);
		$s->bindValue(':name',$name);
		$s->bindValue(':username', $username);
		$this->pdo->beginTransaction();
		$s->execute();
		$row = $s->fetch(\PDO::FETCH_OBJ);
		if ($row===false) {
			$q2 = "insert into `$this->table` (`name`,`value`,`username`) values (:name,:value,:username)";
		} else {
			$q2 = "update `$this->table` set `value`=:value where `name`=:name and `username`=:username";
		}
		$s = $this->pdo->prepare($q2);
		$s->bindValue(':name',$name);
		$s->bindValue(':value',$value);
		$s->bindValue(':username', $username);
		$s->execute();
		$this->pdo->commit();
	}
	
	function delete($name, $username) {
		$q = "delete from `$this->table` where `name`=:name and `username`=:username";
		$s = $this->pdo->prepare($q);
		$s->bindValue(':name',$name);
		$s->bindValue(':username', $username);
		$s->execute();
	}
	
	function deleteAll($username) {
		$q = "delete from `$this->table` where `username`=:username";
		$s = $this->pdo->prepare($q);
		$s->bindValue(':username', $username);
		$s->execute();
	}
	
}