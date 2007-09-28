<?php

require_once($baseDir . 'controllers/ViewController.php');

class SetupController extends ViewController
{
	function SetupController($uri)
	{
	  if(isset($uri))
	    {
	      $this->dispatch($uri);
	    }
	  else
	    {
	      //$this->checkPermissions();
	      $this->detectEnvironment();
	      $this->writeHtaccess();
	      $this->setupBaseURI();
	    }
	}
	
	function dispatch($uri)
	{
	  switch($i)
	    {
	    case "database":
	      // db
	      break;
	    case "firstuser":
	      // firstuser
	      break;
	    }
	}

	function index()
	{
	}

	function checkPermissions()
	{
	}

	function setupBaseURI()
	{
	  $this->writeHTMLHeader();
	  echo('Thanks for installing Broadcast Machine!' . "\n");
	  echo("First off, we need to figure out your base URL. </br>");
	  echo("Just point your browser to the URL that you want to use as your base! </br>");
	  $baseURI = $_SERVER['REQUEST_URI'];
	  echo("<br/><br/>");
	  echo("We've detected that your current URI is {$baseURI}!");
	  echo("If you'd like to use this as your root URI, click 'next' below.");
	  echo("If you'd like to use a different URI, enter it into the address bar!");
	  
	  if(getSetting("CleanURIs") == "On")
	    {
	      $baseURI = $baseURI . "setup/database";
	    }
	  else
	    {
	      $baseURI = $baseURI . "index.php/" . "setup/database";
	    }

	  echo("<form method=\"POST\" action=\"$baseURI\">");
	  echo('<input type="submit" value="Get started!">');
	  echo("<input type=\"hidden\" name=\"baseURI\" value=\"{$baseURI}\">");
	  echo('</form>');
	  $this->writeHTMLFooter();
	}
	
	function setupDatabase()
	{
	  // Save the baseURI if we get sent it.
	  if(isset($_POST['baseURI']))
	    {
	      setSetting("baseURI", $_POST['baseURI']);
	    }
	  if(isset($_POST['MySQLData']))
	    {
	   
	    }	
	  elseif(isset($_POST['SQLiteData']))
		{
		
		}
	  else
	    {
	      $this->displayDBSetupForm();
	    }		
	}

	function displayDBSetupForm()
	{
		$this->writeHTMLHeader();
		echo('<div class="greeting">Thanks for installing Broadcast Machine!</div>');
		echo('<div class="mysql_setup">');
		echo('<form action="{$baseURI . " method="POST">');
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

	function setupFirstUser()
	{
	  // Validate incoming data.
	  if(isset($_POST['FirstUser']))
	    {
	      // Make sure the username is valid.
	      // Check to see if the passwords are the same.
	      // Make sure the email address is properly formatted.
	    }
	    else
	      {
		$this->displayNewUserForm();		
	      }  
	}

	function displayNewUserForm()
	{
	  $this->writeHTMLHeader();
	  echo("Time to pick a username! <br/>");
	  echo("<form action=\"{$baseURI}/setup/firstuser\" method=\"POST\">");
	  echo("Username: <input type=\"text\" name=\"username\"><br/>");
	  echo("Password: <input type=\"text\" name=\"password\"><br/>");
	  echo("Confirm Password: <input type=\"text\" name=\"confirmpassword\"><br/>");
	  echo("Email: <input type=\"text\" name=\"email\"><br/>");
	  echo("<input type=\"hidden\" name=\"FirstUser\" value=\"TRUE\">");
	  echo("</form>");
	  $this->writeHTMLFooter();
	}

	function detectEnvironment()
	{
	  // Figure out the base directory.
	  $cur_dir = getcwd() . "/";
	  setSetting("baseDir", $cur_dir);

	  // See if magic quotes are turned on.
	  setSetting("MagicQuotesGPC", get_magic_quotes_gpc()); /* GET/POST/Cookie data. */
	  setSetting("MagicQuotesRuntime", get_magic_quotes_runtime()); /* Database, file operations. */

	  // Is mod_rewrite installed?
	  if(array_search("mod_rewrite", apache_get_modules()) != FALSE)
	    {
	      setSetting("CleanURIs", "On");
	    }
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

	function writeHtaccess()
	{
	  echo("writeHtaccess is still a stub...");
	}
}
