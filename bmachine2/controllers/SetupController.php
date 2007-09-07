<?php

// These two functions are to be used by any part of BM2 that needs
// to store simple settings as key/value pairs. These should be used
// as infrequently as possible. The database should be used whenever
// possible. These are a last resort!

// Takes in a key and returns a value. Returns NULL if the key
// doesn't exist.
function getSetupValue($key)
{
	$handle = fopen("../settings.inc", "r");

	while($setupdata = fscanf($handle, "%s\t%s\n"))
	{
		list ($read_key, $read_value) = $setupdata;

		if($read_key == $key)
		{
			$value = $read_value;
		}
	}
		
	fclose($handle);	    
	return $value;
}

// Takes in a key and a value to be written to the file. Returns TRUE
// if the values were written and FALSE if not. If the key already
// exists, it's value is overwritten with the new value.
function setSetupKey($key, $value)
{
	$handle = fopen('../settings.inc', 'at');

	$pair = $key . "\t" . $value . "\n";	

	$status = fwrite($handle, $pair);
			
	fclose($handle);

	if($status = FALSE)
	{
		return FALSE;
	}
}

function isSetupDone()
{
	if(getSetupValue('SetupStatus') == 'done')
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

class SetupController
{
	function SetupController()
	{
		$this->setupDatabase();
	}

	function setupDatabase()
	{
		if(isset($_POST['MySQLData']))
		{
			
		}	
		elseif(isset($_POST['SQLiteData']))
		{
		
		}
		else
		{
			$this->writeMySQLPage();
		}		
	}

	function writeMySQLPage()
	{
		$this->writeHTMLHeader();
		echo('<div class="greeting">Thanks for installing Broadcast Machine!</div>');
		echo('<div class="mysql_setup">');
		echo('<form action="" method="POST">');
		echo('Hostname: <input type="text" name="hostname"><br/>');
		echo('DB Name: <input type="text" name="dbname"><br/>');
		echo('Username: <input type="text" name="username"><br/>');
		echo('Password: <input type="text" name="password"><br/>');
		echo('<input type="hidden" name="MySQLData">');
		echo('<input type="submit">');
		echo('</form>');
		echo('</div>');
		$this->writeHTMLFooter();
	}

	function writeMessage($message)
	{
		$this->writeHTMLHeader();
		echo($message . "<br/>");
		$this->writeHTMLFooter();
	}
	
	function writeHTMLHeader()
	{
		echo("<html><head><title>");
		echo("Broadcast Machine Setup");
		echo('</title><style type="text/css">');
		$this->writeStylesheet();
		echo('</head><body><div class="body">');
	}
	
	function writeHTMLfooter()
	{
		echo('</div></body></html>');
	}
	
	function writeStylesheet()
	{
		// CJ - Stylesheet should go here. Maybe it could work as an included file? (setup.css?)
	}

	

}
