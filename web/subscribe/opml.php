<?php

header('Content-type: application/x-democracy');
header('Content-Disposition: inline; filename="subscribe.democracy"');
include "opml-string.php";
echo getOPML();

?>
