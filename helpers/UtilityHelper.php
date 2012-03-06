<?php

  // Functions that help you out, but don't really belong anywhere.

  // Removes the empty elements of an array from the front and back.
function array_trim($a) { 
  $j = 0; 
  $b = null;
  for ($i = 0; $i < count($a); $i++) { 
    if ($a[$i] != "") { 
      $b[$j++] = $a[$i]; 
	  } 
  } 
  return $b; 
}

// Returns the maximum allowed POST size in bytes.
function getMaxPost() {
  if(!ini_get('file_uploads')) {
    return 0;
  } else {
    return min(getBytes(ini_get('upload_max_filesize')),
               getBytes(ini_get('post_max_size')));
  }
}

// From the PHP manual.
// http://us3.php.net/manual/en/function.ini-get.php
//
// Takes in an ambiguous size value and returns an integer of bytes.
function getBytes($val) {
    $val = trim($val);
    $last = strtolower($val{strlen($val)-1});
    switch($last) {
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }
    return $val;
}

?>
