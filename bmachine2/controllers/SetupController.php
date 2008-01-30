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
		$contents = "";
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
