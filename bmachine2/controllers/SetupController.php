<?php

require_once($baseDir . 'controllers/ViewController.php');

class SetupController extends ViewController
{
	function dispatch($params) {
		//If we've got users, authenticate
		if (isset($this->db_controller->connection)) {
			$users =  $this->db_controller->read("users", "all");
			if (count($users) > 0) {
				if (!($this->isAdmin())) {
					$this->forbidden();	 
					return;
				}
			}
		}

		switch($params[1]) {
		  case 'cleanurls':
		    $this->write_htaccess();
		    break;
		  case 'database':
		    $this->database();
		    break;
		  default:
		    $this->index();
		}
	}

	//The index function serves as the settings page logic after setup
	function index() {

	}
	
	//Sets up database
	function database() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (!$this->write_bm2conf()) {
				$this->display('error-permissions.tpl');
				return;
				//Set up the database
				$this->display('setup-firstuser.tpl');
			}
		} else {
			$this->display('setup-database.tpl');
		}
	}

	//Creates a .htaccess file from scratch
	function write_htaccess() {
		$rewriteBase = str_replace(array("index.php", "setup", "setup/"),'',$_SERVER['REQUEST_URI']);
		//A big string to denote the contents of the .htaccess file	
		$htcontents =  "## Broadcast Machine 2 URI rewrite config.
				
## For when mod_rewrite is dynamically loaded.
<IfModule mod_rewrite.so>
	RewriteEngine On
	RewriteBase $rewriteBase 
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . $rewriteBase"."index.php [L]
</IfModule>
				
## For when mod_rewrite is compiled in. (Ubuntu default!)
<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteBase $rewriteBase 
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . $rewriteBase"."index.php [L]
</IfModule>
				
# libphp5, what about mod_php, statically/dynamically compiled?
<IfModule libphp5.so>
	# Disable magic quotes.
	php_flag magic_quotes_gpc Off
</IfModule>";
		($this->write_file('.htaccess', $htcontents)) ? $this->display('setup-cleanurls.tpl') : $this->display('error-permissions.tpl');
	}

	//Creates bm2_conf.php from scratch
	function write_bm2conf() {
		//Auto-detect basedir, baseurl
		$baseDir = getcwd().'/';
		$baseURI = str_replace(array("index.php", "setup", "setup/"),'',$_SERVER['REQUEST_URI']);
		$contents = 	'<?php
## Configuration file for Broadcast Machine 2
				
# Relative to your webserver root, where is bm2 installed?
# Remember to change your .htaccess file when this changes.
# NOTE: If bm2 is installed in the root dir, leave this blank!
# Example: If the url is http://sample.com/apps/bm2/, then this should be /apps/bm2/
$baseUri = "'.$baseURI.'";
				
# What directory is bm2 installed into?
# Be sure to add the trailing slash!
$baseDir = "'.$baseDir.'";
	
# Should we use clean URLs?
# Should be "Off" or "On", be careful, it\'s case sensitive!
$cleanUris = "On";
				
# Database configuration options.
# These are used by any database controller that needs to connect.
$cf_dbengine = "MySQL"; // Which engine do you want to use? (MySQL, SQLite, Postgres...)
$cf_hostname = "'.$_POST['hostname'].'"; // What\'s the hostname?
$cf_database = "'.$_POST['dbname'].'"; // Which database should we use?
$cf_username = "'.$_POST['username'].'";
$cf_password = "'.$_POST['password'].'";
?>';

		return $this->write_file('bm2_conf.php', $contents);
	}

	//Helper to write a file given a filename and big string
	//Returns boolean for success/fail
	function write_file($filename, $contents) {
		$file = fopen($filename, 'w');
                if (!$file) {
			return false;
                } else {
                        fputs($file,$contents);
                        fclose($file);
			return true;
                }
	}
}
