<?php 

namespace drey\Prefs\Test;

class DBSuite extends \PHPUnit_Framework_TestCase {

	public function basicTests($db) {
		$db->deleteAll('drey');
		$db->deleteAll('jim');

		$db->set('bird','eagle','drey');
		$db->set('city','Valencia','drey');
		$db->set('fruit','mango','drey');

		$db->set('fruit','pear','jim');
		$db->set('bird','owl','jim');

		$row = $db->get('fruit','drey');
		$this->assertEquals($row->value,'mango');

		$row = $db->get('fruit','jim');
		$this->assertEquals($row->value,'pear');

		$all = $db->getAll('drey');
		$this->assertEquals(3,count($all));

		$db->delete('bird','drey');
		$row = $db->get('bird','drey');
		$this->assertEquals($row,false);

		$row = $db->get('bird','jim');
		$this->assertEquals($row->value,'owl');

	}
}