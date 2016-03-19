<?php


namespace drey\Prefs\Test;
use drey\Prefs\Factory;

class FactoryTest extends PrefsSuite  {

	public function test1() {
		$prefs = Factory::fileSystem('/tmp','bob');
		$this->basicTests($prefs);
	}

	public function test2() {
		$pdo = $this->connect();
		$prefs = Factory::pdo($pdo,'bob');
		$this->basicTests($prefs);
	}

}