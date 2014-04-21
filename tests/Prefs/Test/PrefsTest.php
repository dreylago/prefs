<?php

namespace drey\Prefs\Test;

use drey\Prefs\Prefs;
use drey\Prefs\DB\PDOInstance;
use drey\Prefs\DB\FileSystem;

class PrefsTest extends PrefsSuite {

	public function connect() {
		try {
    			$conn = new \PDO('mysql:host=localhost;dbname=test', 'testuser', '123456');
    			$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    			return $conn;
		} catch(PDOException $e) {
    		echo 'ERROR: ' . $e->getMessage();
		}
		return NULL;
	}

	public function create($pdo) {
		$q = "drop table  if exists prefs";
		$pdo->query($q);
		$q = file_get_contents(dirname(__FILE__) . '/../../../sql/create.mysql.sql');
		$pdo->query($q);
	}

	public function testPrefs() {
		$pdo = $this->connect();
		$this->create($pdo);
		$db = new PDOInstance($pdo);
		$prefs = new Prefs($db);
		$this->basicTests($prefs);
		$this->defaultUsernameTests($prefs);

		$db = new FileSystem('/tmp');
		$prefs = new Prefs($db);
		$this->basicTests($prefs);
		$this->defaultUsernameTests($prefs);

	}



	

}