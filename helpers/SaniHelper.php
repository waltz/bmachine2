<?php

// Brought to you by SaniTaco.

// Functions that strip HTML tags and escape SQL commands.

function stripHTML($string)
{
  return strip_tags($string);
}

function array_addslashes($array)
{
  if(is_array($array))
    {
      $newarray = array();
      foreach($array as $index => $string)
	{
	  $newarray[$index] = addslashes($string);
	}
      return $newarray;
    }
}

function array_strip_tags($array)
{
  if(is_array($array)){
    $newarray = array();
    foreach($array as $index => $string){
      if(is_array($string)){
	$weirdArray = array();
	foreach($string as $element){
	  $weirdArray[] = strip_tags($element);
	}
	$newarray[$index] = $weirdArray;
      } else {
	$newarray[$index] = strip_tags($string);
      }
    }
    return $newarray;
  } else {
    return $array;
  }
}

?>