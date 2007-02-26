<?php

// Simple, just includes the dispatcher.
//include('dispatcher.php');

$url = $_SERVER['REQUEST_URI'];
$url = strip_tags($url);
$parts = explode('/', $url);

print_r($parts);

?>
