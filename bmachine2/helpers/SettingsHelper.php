<?php

//Functions to read and set settings:

// Takes in a key and returns a value. Returns NULL if the key
// doesn't exist.
function getSetting($key)
{
      	$handle = fopen("settings.inc", "r");
	$value = NULL;

        while($setupdata = fscanf($handle, "%s\t%s\n")) {
                list ($read_key, $read_value) = $setupdata;

      	        if($read_key == $key)
               		{$value = $read_value;}
      	}
      	fclose($handle);
        return $value;
}

// Takes in a key and a value to be written to the file. Returns TRUE
// if the values were written and FALSE if not. If the key already
// exists, it's value is overwritten with the new value.
function setSetting($key, $value)
{
  try
    {
      	$handle = fopen('settings.inc', 'at');

        $pair = $key . "\t" . $value . "\n";

      	$status = fwrite($handle, $pair);

        fclose($handle);

      	if($status = FALSE)
      	{
	  return FALSE;
	}
    }
  catch(Exception $e)
    {
      echo("Couldn't open settings file.");
    }
}
	
?>
