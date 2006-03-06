<?php
/**
 * file detail display
 * @package Broadcast Machine
 */
require_once("include.php");
require_once("theme.php");

// processing here in case our rewrite rules choke
if ( !isset($_GET["i"]) && !isset($_GET["c"]) ) {
	$params = split("/", $_SERVER['REQUEST_URI']);

	if ( count($params) == 5 ) {
		$_GET["c"] = $params[3];
		$_GET["i"] = $params[4];
	}
}


if(!isset($_GET["i"]) || !isset($_GET["c"])) {
  header('Location: ' . get_base_url() . "index.php" );
  exit;
}

$file = $store->getFile($_GET["i"]);

if ( !isset($file) ) {
	die("Couldn't find your file");
}

$channel = $store->getChannel($_GET["c"]);
if ( !isset($channel) ) {
	die("Couldn't find channel");
}

if ( ! $store->channelContainsFile($_GET["i"], $channel) ) {
	die("Wrong channel for this file!");
}

front_header($channel["Name"],$_GET["c"],$channel["CSSURL"], get_base_url() . "rss.php?i=" . $_GET["c"]);
?>

<div id="show_all"><a href="<?php print channel_link($_GET["c"]);  ?>">Show All Videos</a></div>
<div class="spacer">&nbsp;</div>
<div id="video_zone">

  <div class="single_video">
    <div class="thumb_wrap">
            <div class="thumbnail"><?php
  print("<img src=\"");
  
  if ($file['Image'] == '' || ! $channel['Options']['Thumbnail']) {
    print("t.gif");
  } 
  else {
    print($file['Image']);
  }
  
  print("\" width=\"180\" alt=\"" . $file["Title"] . "\"/>");
  ?></div>
<?php


// if this is a torrent, provide two links - one to the torrent and one to Easy Downloader
//$url = "download.php?c=" . $channel["ID"] . "&amp;i=" . $_GET["i"];
$url = download_link($channel["ID"], $_GET["i"]);
$ezurl = download_link($channel["ID"], $_GET["i"], true);
if ( is_local_torrent($file["URL"]) ) {
  print ("<div class=\"dl_links\"><a href=\"$url\">Torrent File</a> - <a href=\"$ezurl\">Easy Downloader</a></div>");	  
}

// otherwise, just a direct link
else {
  print ("<div class=\"dl_links\"><a href=\"$url\">download</a></div>");
}
?>

</div>

<div class="video_info">
<?php

if ( isset($file['Title']) && $file['Title'] != "") {
  print("<div class=\"video_title\">" . $file["Title"] . "</div>");
}

if ( isset($file['Creator']) && $file['Creator'] != "") {
  print("<div class=\"creator_name\">by " . $file["Creator"] . "</div>");
}

if ( isset($file['Description']) && $file['Description'] != "") {
  print("<div class=\"video_description\">" . str_replace("\n","<br/>",$file["Description"]) . "</div>");
}

if ( isset($file['RuntimeHours']) && $file['RuntimeHours'] != "") {
  print("<div class=\"video_stats\">");
  print("<div class=\"published_date\">Posted " . date("F j, Y", $file["Publishdate"]) . " - </div>");
  if (($file["RuntimeHours"] || $file["RuntimeMinutes"] || $file["RuntimeSeconds"])) {
    $runtime = "";
    
    if ($file["RuntimeHours"] != "") {	
      $runtime .= $file["RuntimeHours"] . " hr. ";
    }
    
    if ($file["RuntimeMinutes"] != "") {
      $runtime .= $file["RuntimeMinutes"] . " min. ";
    }
    
    if ($file["RuntimeSeconds"] != "") {
      $runtime .= $file["RuntimeSeconds"] . " sec. ";
    }
    
    if ($runtime != "") {
      print("<div class=\"duration\">" . $runtime . "</div>");
    }
  }
}

// cjm - fixed a typo error here (06/03/2005)
if ($file["LicenseName"] && isset($file["LicenseURL"])) {
  print "
<div class=\"license\">
License: <a rel=\"license\" href=\"" . $file["LicenseURL"] . "\" target=\"_blank\">" . $file["LicenseName"] . "</a>
</div>";
  display_cc_metadata($file);
}


//
// if this is a torrent, then display the seeder/downloader info here
//

if ( is_local_torrent($file["URL"]) ) {
//  $return_url = "detail.php?c=" . $_GET["c"] . "&amp;i=" . $_GET["i"] ;
  $return_url = "detail.php?c=" . $_GET["c"] . "&amp;i=" . $_GET["i"] ;
  displayTorrentInfo($file["URL"], $_GET["i"], $return_url );
}


$size = get_filesize($file["URL"]);
if ( $size ) {
	$size /= 1024;
	if ( $size < 1024 ) {
		$size = sprintf("%0.0f KB", $size);
	}
	else {
		$size /= 1024;
		$size = sprintf("%0.0f MB", $size);
	}
	
	print "<div class=\"file_size\">Size: " . $size . "</div>";
}

?>

</div>


<div class="production_details">

<?php

   if ($file["ReleaseYear"] || $file["ReleaseMonth"] || $file["ReleaseDay"]) {
     
     print("<div class=\"release_date\">Release Date: ");
     
     if ($file["ReleaseMonth"]) {
       print(date("F", strtotime($file["ReleaseMonth"] + 1 . "/1/1999")));
     }
     
     if ($file["ReleaseDay"]) {
       print(" " . $file["ReleaseDay"]);
     }
     
     if ($file["ReleaseMonth"] || $file["ReleaseDay"]) {
       print(", ");
     }
     
     print($file["ReleaseYear"] . "</div>");
     
   }
 
 if ($file["Webpage"]) {
   print("<div class=\"associated_website\"><a href=\"" . $file["Webpage"] . "\">Related Webpage</a></div>");
 }
  
 if ($file["People"]) {
   
   print("<div class=\"people_involved\">");
   
   $i = 0;
   
   foreach ($file["People"] as $people) {
     if ($people[0] != '') {
       if ($i != 0) {
				 print("<br/>");
       }
       print($people[1] . ": " . $people[0]);
       $i++;
     }
   }
   
   print("</div>");

 }
?>
		
</div>

<?php


if ( $file["Keywords"] ) {

  print("<div class=\"tags\"><strong>Tags:</strong> ");
  
  $i = 0;
  
  foreach ($file["Keywords"] as $keyword) {
    if ($i > 0) {
      print(", ");
    }
    $i++;
    if ( is_array($keyword) ) {
      $keyword = $keyword[0];
    }
		print("<a href=\"library.php?i=" . $channel["ID"] . "&amp;kw=" . urlencode($keyword) . "\">" . $keyword . "</a>");
  }
  
  print("</div>");
  
}

if ($file["Explicit"]) {
  print("<div class=\"explicit_content\">Contains Explicit Content</div>");
}

//
// if there's some donation text for this file, then let's display it
//
if ( isset($file["donation_id"]) && $file["donation_id"] != "" ) {
	$donation = $store->getDonation($file["donation_id"]);

	if ( isset($donation) && isset($donation["text"]) && $donation["text"] != "" ) {
?>

<div id="donation_text">
<?php 
		print $donation["text"];
?>
</div>
<?php
	} // if ( donation exists )
} // if ( donation specified )

  if ($file["Transcript"]) {
 		if ( isset($_GET["t"]) ) {
			print "<div id=\"transcript\">\n";
			print "<h3>Transcript</h3>";
			$trans_text = file_get_contents($file["Transcript"]);
			print str_replace("\n", "<br>", $trans_text);
			print "</div>";
		}
		else {
	  	print("<div class=\"transcript_link\"><a href=\"detail.php?c=" . $_GET["c"] . "&amp;i=" . $_GET["i"] . "&amp;t=1\">Transcript</a></div>");
		}
 }

?>

</div>
</div>

<div class="spacer_left">&nbsp;</div>
<?php
front_footer($_GET["c"]);

/**
 * generate some embedded Creative Commons metadata
 */
function display_cc_metadata($file) {
?>
<!--
<rdf:RDF xmlns="http://web.resource.org/cc/" 
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<Work rdf:about=""> 
  <license rdf:resource="<?php echo $file["LicenseURL"];?>" /> 
<?php
  if ( isset($file["Title"]) && $file["Title"] != "" ) {
?>
  <dc:title><?php echo $file["Title"]; ?></dc:title>
<?php
  }
 if ( isset($file[Description]) && $file["Description"] != "" ) {
?>
  <dc:description><?php echo $file["Description"]; ?></dc:description>
<?php
  }
   if ($file["ReleaseYear"] || $file["ReleaseMonth"] || $file["ReleaseDay"]) {
?>
       <dc:date><?php echo $file["ReleaseYear"]; ?></dc:date> 
<?php
   }
   if (isset($file["Creator"]) && $file["Creator"]) {
?>
       <dc:creator>
         <Agent> 
           <dc:title><?php echo $file["Creator"]; ?></dc:title>
         </Agent>
        </dc:creator> 
<?php
    }
?>
</Work>
</License>
</rdf:RDF>
-->

<?php
}


/*
 * Local variables:
 * tab-width: 2
 * c-basic-offset: 2
 * indent-tabs-mode: nil
 * End:
 */

?>