<?php

include "geturls.php";

function wrapString($url) {
  $url = htmlspecialchars($url);
  return '<outline text="' . $url . '" type="rss" version="RSS2" xmlUrl="' . $url . '"/>
';
}

function getOPML() {
  $dateString = htmlentities(date("r"));
  $output = '<?xml version="1.0" encoding="UTF-8"?>
';
  $output = $output . <<< EOT
<opml version="2.0">
	<head>
		<title>Democracy Subscriptions</title>
		<dateCreated>$dateString;</dateCreated>
		<dateModified>$dateString;</dateModified>
	</head>
	<body>

EOT;
  $output = $output . join ("", array_map("wrapString", getURLs()));
  $output = $output . <<< EOT
</body>
</opml>
EOT;
  return $output;
}
?>
