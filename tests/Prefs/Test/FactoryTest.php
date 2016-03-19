<?php


namespace drey\Prefs\Test;
use drey\Prefs\Factory;

class FactoryTest extends PrefsSuite  {

	public function test1() {
		$prefs = Factory::fileSystem('/tmp','bob');
		$this->basicTests($prefs);
	}

}