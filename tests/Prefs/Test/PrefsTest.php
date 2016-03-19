<?php

namespace drey\Prefs\Test;

use drey\Prefs\Prefs;
use drey\Prefs\DB\PDOInstance;
use drey\Prefs\DB\FileSystem;

class PrefsTest extends PrefsSuite {

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
		$this->globalUsernameTests($prefs);

		$db = new FileSystem('/tmp');
		$prefs = new Prefs($db);
		$this->basicTests($prefs);
		$this->defaultUsernameTests($prefs);
		$this->globalUsernameTests($prefs);

	}



	

}