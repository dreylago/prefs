<?php 

namespace drey\Prefs\Test;

use drey\Prefs\DB\PDOInstance;

class PDOInstanceTest extends DBSuite {

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

	public function testWriteRead() {
		$pdo = $this->connect();
		$this->create($pdo);
		$db = new PDOInstance($pdo,'prefs');
		$this->basicTests($db);
	}



	

}