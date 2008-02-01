<?php

require_once($baseDir . 'controllers/ViewController.php');

class SetupController extends ViewController
{
	function dispatch($params) {
		$this->index();
	}

	//The index function checks to see where setup left off and calls the appropriate function
	function index()
	{

	}
	
	//Creates a .htaccess file from scratch
	function write_htaccess() {
		$rewriteBase = getcwd().'/';
		//A big string to denote the contents of the .htaccess file	
		$htcontents =  "## Broadcast Machine 2 URI rewrite config.\n
				\n
				## For when mod_rewrite is dynamically loaded.\n
				<IfModule mod_rewrite.so>\n
				\tRewriteEngine On\n
				\tRewriteBase $rewriteBase \n
				\tRewriteCond %{REQUEST_FILENAME} !-f\n
				\tRewriteCond %{REQUEST_FILENAME} !-d\n
				\tRewriteRule . $rewriteBase"."index.php [L]\n
				</IfModule>\n
				\n
				## For when mod_rewrite is compiled in. (Ubuntu default!)\n
				<IfModule mod_rewrite.c>\n
				\tRewriteEngine On\n
				\tRewriteBase $rewriteBase \n
				\tRewriteCond %{REQUEST_FILENAME} !-f\n
				\tRewriteCond %{REQUEST_FILENAME} !-d\n
				\tRewriteRule . $rewriteBase"."index.php [L]\n
				</IfModule>\n
				\n
				# libphp5, what about mod_php, statically/dynamically compiled?\n
				\t<IfModule libphp5.so>\n
				\t# Disable magic quotes.\n
				\tphp_flag magic_quotes_gpc Off\n
				</IfModule>";
		write_file('.htaccess', $htcontents);
	}

	//Creates bm2_conf.php from scratch
	function write_bm2conf() {
		//Auto-detect basedir, baseurl
		$baseDir = getcwd().'/';
		$baseURI = $_SERVER['REQUEST_URI'];
		$contents = 	'<?php\n
				## Configuration file for Broadcast Machine 2\n
				\n
				# Relative to your webserver root, where is bm2 installed?\n
				# Remember to change your .htaccess file when this changes.\n
				# NOTE: If bm2 is installed in the root dir, leave this blank!\n
				# Example: If the url is http://sample.com/apps/bm2/, then this should be /apps/bm2/\n
				$baseUri = "'.$baseURI.'";\n
				\n
				# What directory is bm2 installed into?\n
				# Be sure to add the trailing slash!\n
				$baseDir = "'.$baseDir.'";\n
				\n
				# Should we use clean URLs?\n
				# Should be "Off" or "On", be careful, it\'s case sensitive!\n
				$cleanUris = "On";\n
				\n
				# Database configuration options.\n
				# These are used by any database controller that needs to connect.\n
				$cf_dbengine = "MySQL"; // Which engine do you want to use? (MySQL, SQLite, Postgres...)\n
				$cf_hostname = "'.$_POST['hostname'].'"; // What\'s the hostname?\n
				$cf_database = "'.$_POST['database'].'"; // Which database should we use?\n
				$cf_username = "'.$_POST['username'].'";\n
				$cf_password = "'.$_POST['password'].'";\n
				?>';
		write_file('bm2_conf.php', $contents);
	}
	//Helper to write a file given a filename and big string
	function write_file($filename, $contents) {
		$file = fopen($filename, 'w');
                if (!$file) {
                        $this->display('error-permissions.tpl');
                } else {
                        fputs($file,$contents);
                        fclose($file);
                }
	}
}
