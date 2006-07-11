<?php
  header('Content-type: text/plain');
  header('Content-Disposition: attachment; filename="subscribe.feedlist"');
  include "geturls.php";

  echo join ("\n", getURLs());
  echo "\n"
?>
