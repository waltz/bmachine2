<?php

  // Functions that help you out, but don't really belong anywhere.

  // Removes the empty elements of an array from the front and back.
function array_trim($a) 
{ 
  $j = 0; 
  $b = null;
  for ($i = 0; $i < count($a); $i++) 
    { 
      if ($a[$i] != "") 
	{ 
	  $b[$j++] = $a[$i]; 
	} 
    } 
  return $b; 
}

?>
