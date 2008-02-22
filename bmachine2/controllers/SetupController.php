<?php

require_once($baseDir . 'controllers/ViewController.php');
require_once($baseDir . 'controllers/MySQLController.php');

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
			} else {
				$this->firstuser();
				$bm_debug = "setup";
				return;
			}
		}
		if (!isset($params[1])) {$params[1] = '';}
		switch($params[1]) {
		  case 'cleanurls':
		    $this->write_htaccess();
		    break;
		  case 'settings':
		    $this->settings();
		    break;
		  default:
		    $this->index();
		}
	}

	//The only time index is called is when you don't have permission to access it
	function index() {
	}
	
	function firstuser() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if($_POST['pass'] != $_POST['password_confirm']) { 
                  		$this->alerts[] = 'Make sure the passwords match!';
                  		$this->view->assign('alerts', $this->alerts);
                  		$this->view->assign('username', $_POST['username']);
                  		$this->view->assign('name', $_POST['name']);
                  		$this->view->assign('email', $_POST['email']);
                  		$this->display('setup-firstuser.tpl');
                  		return;
                	}

	              	// Hash the password.
        	      	$_POST['pass'] = sha1($_POST['pass']);

			// Build the user data array.
              		$user = array(
				'name' 		=> $_POST['name'],
                            	'username' 	=> $_POST['username'],
                            	'pass' 		=> $_POST['pass'],
                            	'email' 	=> $_POST['email'],
			    	'active' 	=> true,
			    	'admin' 	=> true);

	              	// Add the new user to the database.
        	      	$this->db_controller->create("users", $user);
			$_SESSION['username'] = $_POST['username'];

			$this->display('setup-finished.tpl');
		} else {
			$this->display('setup-firstuser.tpl');
		}
	}
	//Sets up settings
	function settings() {
		global $cf_hostname,  $cf_username, $cf_password, $cf_database, $baseDir;

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//Connect to the database
			$cf_dbengine = "MySQL";
			$cf_hostname = $_POST['hostname'];
			$cf_database = $_POST['database'];
			$cf_username = $_POST['username'];
			$cf_password = $_POST['password'];
			$site_name   = $_POST['site_name'];
			$site_description   = $_POST['site_iconurl'];
			$site_iconurl   = $_POST['site_iconurl'];
			echo $site_name."<br/>";
	                echo $site_description."<br/>";
        	        echo $site_iconurl."<br/>";

			//Input validation
			if ($_POST['site_name'] == '') {
				$this->alerts[] = "Site name shouldn't be blank";
				unset($_POST['password']);
                                foreach ($_POST as $field => $value) {$this->view->assign($field, $value);}  
				$this->display('setup-settings.tpl');
				return;
			}
			if (!isset($_POST['site_iconurl'])) {$_POST['site_iconurl'] = '';}
			if (!isset($_POST['site_description'])) {$_POST['site_description'] = '';}

			try {
				if (!($this->db_controller)) 
					{$this->db_controller = new MySQLController();}
			} catch (Exception $e) {
				$this->alerts[] = 'We couldn\'t connect to the database using the information you provided. Please double-check the information and try again.';
				unset($_POST['password']);
                                foreach ($_POST as $field => $value) {$this->view->assign($field, $value);}  
				$this->display('setup-settings.tpl');
				return;
			}

			if ($this->db_controller->load($baseDir.'db/MySQLSchema.sql')) {
				//Write configuration file
				if (!$this->write_bm2conf()) {
					$this->display('error-permissions.tpl');
					return;
				}
				$this->alerts[] = "Site settings saved. Thanks!";

				global $users;
				$users =  $this->db_controller->read("users", "all");

				if (count($users) > 0) {
					$this->index();	
				} else {
					$this->display('setup-firstuser.tpl');
				}
			} else {
				$this->display('error-database.tpl');	
			}
		} else {
			//Assign variable names in case someone comes back to change them
			unset($_POST['password']);
                        foreach ($_POST as $field => $value) {$this->view->assign($field, $value);}  
			$this->display('setup-settings.tpl');
		}
	}

	//Creates a .htaccess file from scratch
	function write_htaccess() {
		$rewriteBase = str_replace(array("index.php", "setup", "setup/", "/cleanurls"),'',$_SERVER['REQUEST_URI']);
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
		global $baseDir, $baseUri;

		//$baseDir = getcwd().'/';
		//$baseUri = str_replace(array("index.php", "setup", "setup/", "/settings"),'',$_SERVER['REQUEST_URI']);
		$contents = 	'<?php
## Configuration file for Broadcast Machine 2
				
# Relative to your webserver root, where is bm2 installed?
# Remember to change your .htaccess file when this changes.
# NOTE: If bm2 is installed in the root dir, leave this blank!
# Example: If the url is http://sample.com/apps/bm2/, then this should be /apps/bm2/
$baseUri = "'.$baseUri.'";
				
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
$cf_database = "'.$_POST['database'].'"; // Which database should we use?
$cf_username = "'.$_POST['username'].'";
$cf_password = "'.$_POST['password'].'";

# Site Settings
$site_name = "'.$_POST['site_name'].'";
$site_description = "'.$_POST['site_description'].'";
$site_iconurl = "'.$_POST['site_iconurl'].'";

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
