<?php
include "version.php";
include "base.php";

$winurl = "$base/downloads/windows.php";
$linurl = "$base/downloads/#linux";
$osxurl = "$base/downloads/osx.php";

?>
<script language="JavaScript">
	<!--
function getfile(file, spawnpage)
{
  var browser = (window.navigator.userAgent.indexOf("SV1") != -1);
  window.open(file,'downloading','toolbar=0,location=no,directories=0,status=0, scrollbars=no,resizable=0,width=1,height=1,top=0,left=0');
  window.focus();
  location.href = spawnpage;
}

 if (navigator.appVersion.indexOf("Win")!=-1)
		{
   if ( window.navigator.userAgent.indexOf("MSIE") != -1 ) {
		document.write('<div id="download-button"><a href="javascript:getfile(\'http://ftp.osuosl.org/pub/pculture.org/democracy/win/Democracy-<?= $dtv_version ?>.exe\', \'/downloads/windows.php\');">Version <?= $dtv_version; ?> for Windows</a></div><div id="download-versions">Other versions: <a href="<?= $osxurl ?>">Mac OSX</a> - <a href="<?= $linurl ?>">Linux</a></div>');
   }
   else {
		document.write('<div id="download-button"><a href="<?= $winurl ?>">Version <?= $dtv_version; ?> for Windows</a></div><div id="download-versions">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other versions: <a href="<?= $osxurl ?>">Mac OSX</a> - <a href="<?= $linurl ?>">Linux</a></div>');
   }

		}
	else if (navigator.appVersion.indexOf("Mac")!=-1)
		{
		document.write('<div id="download-button"><a href="<?= $osxurl ?>">Version <?= $dtv_version; ?> for Mac OS X</a></div><div id="download-versions">Other versions: <a href="<?= $winurl ?>">Windows</a> - <a href="<?= $linurl ?>">Linux</a></div>	');
		}
	else if (navigator.appVersion.indexOf("X11")!=-1)
		{
		document.write('<div id="download-button"><a href="<?= $linurl ?>">Version <?= $dtv_version; ?> for Linux</a></div><div id="download-versions">Other versions: <a href="<?= $osxurl ?>">Mac OSX</a> - <a href="<?= $winurl ?>">Windows</a></div>');
		}
	else
		{
		document.write('<div id="download-button"><a href="javascript:getfile(\'http://ftp.osuosl.org/pub/pculture.org/democracy/win/Democracy-<?= $dtv_version ?>.exe\', \'/downloads/windows.php\');">Version <?= $dtv_version; ?> for Windows</a></div><div id="download-versions">Other versions: <a href="<?= $osxurl ?>">Mac OSX</a> - <a href="<?= $linurl ?>">Linux</a></div>');
		}
	//-->
</script>


