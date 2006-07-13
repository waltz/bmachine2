<?php
/*
Plugin Name: Smart Archives
Version: 1.2
Plugin URI: http://justinblanton.com/projects/smartarchives/
Description: A simple, clean, and future-proof way to present your archives.
Author: Justin Blanton
Author URI: http://justinblanton.com
*/

function smartArchives() {

global $tableposts, $PHP_SELF;
setlocale(LC_ALL,WPLANG); // set localization language
// set the URI of your archives; this might not need to be changed (currently, it's http://yoursite.com/archives/)
$archive_uri = get_settings('home')."/";
$now = gmdate('Y-m-d H:i:s'); // get the current GMT date
$qy = mysql_query("SELECT distinct year(post_date) as year, post_status FROM $tableposts WHERE post_status='publish' AND post_date <= NOW() ORDER BY year desc");

// loop to create the small archive block with year/month links
while($years = mysql_fetch_array($qy)) {
echo('<strong><a href="'.$archive_uri.$years[year].'/">'.$years[year].'</a>:</strong> ');
	$qm = mysql_query("SELECT distinct month(post_date) as month FROM $tableposts ORDER BY month asc") or die(mysql_error());
	while($date = mysql_fetch_array($qm)) {
		$q = mysql_query("SELECT *, year(post_date) as year, month(post_date) as month FROM $tableposts WHERE year(post_date)='$years[year]' AND month(post_date)='$date[month]' AND post_status='publish' AND post_date <= NOW() ORDER BY id desc") or die(mysql_error()); 
		$sm =	ucfirst(strftime("%b", strtotime("$date[month]/01/2001"))); // get the shortened month name; strtotime() localizes
		$pd = sprintf("%02s", $date[month]); // pad the month with a zero if needed 	
		if(mysql_num_rows($q)) { echo('<a href="'.$archive_uri.$years[year].'/'.$pd.'/">'.$sm.'</a> '); }
		else {
			if ($sm == "Dec") {
				if ($smPrev == "Nov") { echo('<span class="grey">'.$sm.'</span> '); }
			}
			else { echo('<span class="grey">'.$sm.'</span> '); }
		}
		$smPrev=$sm;
	}
	echo('<br />');
}

echo ('<br /><br />');

$qy = mysql_query("SELECT distinct year(post_date) as year, post_status FROM $tableposts WHERE post_status='publish' AND post_date <= NOW() ORDER BY year desc");

// loop to display links to all posts, sorted by descending month and day
while($years = mysql_fetch_array($qy)) {
	$qm = mysql_query("SELECT distinct month(post_date) as month FROM $tableposts ORDER BY month desc") or die(mysql_error());
	while($date = mysql_fetch_array($qm)) {
		$q = mysql_query("SELECT *, year(post_date) as year, month(post_date) as month FROM $tableposts WHERE year(post_date)='$years[year]' AND month(post_date)='$date[month]' AND post_status='publish' AND post_date <= NOW() ORDER BY id desc") or die(mysql_error());
		if(mysql_num_rows($q)) {
			$lm = ucfirst(strftime("%B", strtotime("$date[month]/01/2001"))); // get the full month name; strtotime() localizes
			$pd = sprintf("%02s", $date[month]); // pad the month with a zero if needed 
			echo('<h2><a href="'.$archive_uri.$years[year].'/'.$pd.'/">'.$lm.' '.$years[year].'</a></h2>');
		    echo('<ul>');
		    $q = mysql_query("SELECT *, year(post_date) as year, month(post_date) as month FROM $tableposts WHERE year(post_date)='$years[year]' AND month(post_date)='$date[month]' AND post_status='publish' ORDER BY post_date desc") or die(mysql_error());
		    while($post = mysql_fetch_array($q)){
				if ($post[post_date_gmt] <= $now) {
					echo('<li><a href="'.get_permalink($post[ID]).'">'.$post[post_title].'</a></li>');
				}
			}
			echo ('</ul><br />');
		}
	}
}

}
?>
