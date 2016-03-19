<?php 

namespace drey\Prefs\Test;

class PrefsSuite extends \PHPUnit_Framework_TestCase {

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

	public function basicTests($prefs) {
		$prefs->deleteAll('drey');
		$prefs->deleteAll('jim');

		$prefs->set('bird','eagle','drey');
		$prefs->set('city','Valencia','drey');
		$prefs->set('fruit','mango','drey');

		$prefs->set('fruit','pear','jim');
		$prefs->set('bird','owl','jim');

		$value = $prefs->get('fruit','apple','drey');
		$this->assertEquals($value,'mango');

		$value = $prefs->get('fruit','apple','jim');
		$this->assertEquals($value,'pear');

		$all = $prefs->getAll('drey');
		$this->assertEquals(3,count($all));

		$prefs->delete('bird','drey');
		$value = $prefs->get('bird','pigeon','drey');
		$this->assertEquals($value,'pigeon');

		$value = $prefs->get('bird','eagle','jim');
		$this->assertEquals($value,'owl');
	}

	public function defaultUsernameTests($prefs) {
		$prefs->deleteAll('bob');
		$prefs->setDefaultUsername('bob');
		
		$prefs->set('bird','canary');
		$prefs->set('city','Maracay');
		$prefs->set('fruit','pineapple');

		$prefs->set('fruit','pear','jim');
		$prefs->set('bird','owl','jim');

		$value = $prefs->get('fruit');
		$this->assertEquals($value,'pineapple');

		$value = $prefs->get('bird');
		$this->assertEquals($value,'canary');

		$value = $prefs->get('country','Venezuela');
		$this->assertEquals($value,'Venezuela');

		$all = $prefs->getAll('bob');
		$this->assertEquals(3,count($all));

	}

	public function globalUsernameTests($prefs) {
		$prefs->deleteAll('*');

		$prefs->set('bird','canary','*');
		$prefs->set('city','Maracay','*');
		$prefs->set('fruit','pineapple','*');

		$value = $prefs->get('fruit','pear','*');
		$this->assertEquals($value,'pineapple');

		$value = $prefs->get('country','Venezuela','*');
		$this->assertEquals($value,'Venezuela');

	}
}