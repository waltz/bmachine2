{* Smarty *}
{* This template uses the following variables:
$sitetitle - the title of the site
$pagetitle - the title of the current page (eg the channel name being viewed)
$cssurl - the url of the style sheet currently being used
$rssurl - the url of the most relevant rss feed
*}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$sitetitle} - {$pagetitle}</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="{$cssurl}"/>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="{$rssurl}" />
</head>
