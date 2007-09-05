<?php

/*
	1.  Display welcome.
	2.	Setup the database.
		a) MySQL/SQLite
		b) hostname
		c) username
		d) password
	3.	Detect Settings
	4.	Create the admin user.
*/	
	
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
