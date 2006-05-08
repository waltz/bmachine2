<?php
/**
 * load and display an RSS feed for the specified channel
 * @package Broadcast Machine
 */

require_once("include.php");

// processing here in case our rewrite rules choke
if ( !isset($_GET["i"]) ) {
  $params = split("/", $_SERVER['REQUEST_URI']);
  $_GET["i"] = $params[count($params) - 1];
  //  $_SERVER["PHP_SELF"] = $_SERVER["SCRIPT_NAME"];
}

$channelID = $_GET["i"];
$forceLoad = isset($_GET["force"]) ? true : false;
$noHeaders = isset($_GET["noheaders"]) ? true : false;

$channels = $store->getAllChannels();
if ( !isset($channels[$channelID]) ) {
  header("HTTP/1.0 404 Not Found");
  exit;
}


$channel = $channels[$channelID];

if ( $noHeaders == true ) {
  header('Content-Type: application/xml');
}
else {
  header('Content-Type: application/rss+xml; charset=utf-8');
  header('Content-Disposition: inline; filename="' . $channelID . '.rss"');
}

if ( isset($channel['RequireLogin']) && $channel['RequireLogin'] == 1 ) {
  // fix bug #1229059 Can view passworded feeds without password
  do_http_auth();
}

if ( $forceLoad == true ) {
  makeChannelRSS($channelID, false);
}

displayChannelRSS($channelID);
?>