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
		document.write('<div id="download-button"><a href="javascript:getfile(\'http://ftp.osuosl.org/pub/pculture.org/democracy/win/Democracy-0.8.4.1.exe\', \'/downloads/windows.php\');">Version 0.8.4.1 for Windows</a></div><div id="download-versions">Other versions: <a href="/downloads">Mac OSX</a> - <a href="/downloads">Linux</a></div>');
   }
   else {
		document.write('<div id="download-button"><a href="/downloads/windows.php">Version 0.8.4.1 for Windows</a></div><div id="download-versions">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other versions: <a href="/downloads">Mac OSX</a> - <a href="/downloads">Linux</a></div>');
   }

		}
	else if (navigator.appVersion.indexOf("Mac")!=-1)
		{
		document.write('<div id="download-button"><a href="/downloads/osx.php">Version 0.8.4.1 for Mac OS X</a></div><div id="download-versions">Other versions: <a href="/downloads">Windows</a> - <a href="/downloads">Linux</a></div>	');
		}
	else if (navigator.appVersion.indexOf("X11")!=-1)
		{
		document.write('<div id="download-button"><a href="downloads/#linux">Version 0.8.4.1 for Linux</a></div><div id="download-versions">Other versions: <a href="/downloads">Mac OSX</a> - <a href="/downloads">Windows</a></div>');
		}
	else
		{
		document.write('<div id="download-button"><a href="javascript:getfile(\'http://ftp.osuosl.org/pub/pculture.org/democracy/win/Democracy-0.8.4.1.exe\', \'/downloads/windows.php\');">Version 0.8.4.1 for Windows</a></div><div id="download-versions">Other versions: <a href="/downloads">Mac OSX</a> - <a href="/downloads">Linux</a></div>');
		}
	//-->
</script>


