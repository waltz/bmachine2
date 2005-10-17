<?php
/**
 * load and display an RSS feed for the specified channel
 * @package Broadcast Machine
 */

require_once("include.php");

$channelID = $_GET["i"];

$channels = $store->getAllChannels();
if ( !isset($channels[$channelID]) ) {
  header("HTTP/1.0 404 Not Found");
	exit;
}

$channel = $channels[$channelID];

header('Content-Type: application/rss+xml; charset=utf-8');

if ( isset($channel['RequireLogin']) && $channel['RequireLogin'] == 1 ) {
	// fix bug #1229059 Can view passworded feeds without password
	do_http_auth();
}

displayChannelRSS($channelID);

?>