<?php

/*
 * Smarty URL Encode
 *
 * A modifier plugin for Smarty that takes in a string
 * and outputs a Broadcast Machine compatible url string.
 *
 */

function smarty_modifier_urlencode($string)
{
  $string = str_replace(' ', '_', $string);
  return $string;
}

?>
