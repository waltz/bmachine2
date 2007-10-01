<?php

require_once('../simpletest/unit_tester.php');
require_once('../simpletest/reporter.php');

include('../controllers/SetupController.php');

class SettingsKeyValueTest extents UnitTestCase
{
	function SettingsKeyValueTest()
	{
		$this->UnitTestCase('Settings file key/value pair test');
	}
	
}

$test = new SettingsKeyValueTest();
$test->run(new HtmlReporter());

?>