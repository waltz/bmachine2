<?php

// I hate PHP
if (get_magic_quotes_gpc()) {
   $_GET    = array_map('stripslashes', $_GET);
}

function getURLs() {
  $urls = array();
  $count = 1;
  while (isset($_GET['url'.$count])) {
    $urls[] = $_GET['url'.$count];
    $count++;
  }
  return $urls;
}
?>