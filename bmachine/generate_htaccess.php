<?php
/**
 * create and upload a .htaccess file using FTP
 * @package Broadcast Machine
 */


global $skip_setup;
$skip_setup = 1;

require_once("include.php");
require_once("ftp.php");

//$hostname = "jerkvision.com";
$hostname = "localhost";
//$username = $_POST["username"];
//$password = $_POST["password"];
//$pwd = $_POST["ftproot"];
$username = "colin";
$password = "webwrkr1";
$pwd = "/home/colin/public_html/bm/";


// generate a list of potential webroots
$folders = array_reverse( explode("/", $pwd) );
$webroots = array();

// always try what the user gave us first - this will either be the filesystem's reported path
// to setup_help.php, or it will be a path the user entered
$webroots[] = $pwd;

$chunk = "";
foreach($folders as $tmp) {
  if ( $tmp != "" ) {
    $chunk = "$tmp/$chunk";
    $webroots[] = "/$chunk";
  }
}

$ftp = new FTP($hostname);

if( $ftp->connect() ) {
  $ftp->is_ok();
  
  if ( ! $ftp->login($username, $password) ) {
  ?>
    <h3>Oops!</h3>
	<p>Looks like there was a problem with the login information you specified.  Please
	back up and try again, or if you prefer, you can use one of the other options
	to set your permissions.</p>
	
  <?php
     exit;
    }
	

    // try each possible web root
    $good_path = false;
    foreach( $webroots as $pwd ) {
      if ( $ftp->cwd($pwd) ) {
	$good_path = true;
	break;
      }
    }

    if ( ! $good_path ) {
      print "
	<h3>Oops!</h3>
	<p>Looks like there was a problem with the directory you specified.  Please
	back up and try again, or if you prefer, you can use one of the other options
	to set your permissions.</p>";
      exit;
    }
		

    // grab existing .htaccess file
    $text = generate_htaccess_text(true);

    // create .htaccess file
    file_put_contents("/tmp/.htaccess", $text);

    // upload it
    $ftp->is_ok();
    //$ftp->ascii();
    $ftp->stor("/tmp/.htaccess", "$pwd/.htaccess");
    ob_flush();
    $ftp->is_ok();
    $ftp->chmod("$pwd/.htaccess", "777");
    $ftp->is_ok();
    //$ftp->chmod("$pwd/index.php", "777");    
    //ob_flush();

    //header('Location: ' . get_base_url() . 'index.php');
	
  }
  else {
    print "Unable to connect!";
  }


//print "<br><br>";
//print "<a href=\"admin.php\">Continue</a>";


?>