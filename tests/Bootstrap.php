<?php

// set autoload path
$autoload_path = 'vendor/autoload.php';
if (!is_readable($autoload_path)) {
	die("set composer autoload path in test/Bootstrap.php");
}
require $autoload_path;








