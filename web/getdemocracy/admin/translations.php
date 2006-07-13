<?php
require_once("../include.php");

function draw_translation_summary($filename) {
  $po = parse_po_file('../pending/'.$filename);
  echo '<div class="transummary">'."\n";
  echo "<pre>";
  $comments = split("#####\n",$po["header"]);
  echo htmlspecialchars($comments[count($comments)-1]);
  echo "</pre>";
  echo '<a href="translations.php?view='.urlencode($filename).'">'._("view").'</a> ';
  echo '<a href="translations.php?delete='.urlencode($filename).'">'._("delete").'</a> ';
  echo '<a href="translations.php?accept='.urlencode($filename).'">'._("accept").'</a>';
  echo '</div>'."\n";
}

function admin_process_translations() {
  $lock = fopen("../pending/LOCK","wb");
  flock($lock,LOCK_EX);

  $files = array();
  $dir = opendir("../pending");
  while ($filename = readdir($dir)) {
    if ((substr($filename,0,1) != '.') &&
	$filename != "LOCK")
      $files[] = $filename;
  }
  sort($files);
  foreach ($files as $filename) {
    draw_translation_summary($filename);
  }
  if (count($files)==0) {
    echo "<p>"._("There are no pending translations.")."</p>";
  }
  flock($lock,LOCK_UN);
  fclose($lock);
}

if (isset($_GET['delete'])) {
  if ((substr($_GET['delete'],0,1)!='.') &&
      (substr($_GET['delete'],0,1)!='/')) {
    $lock = fopen("../pending/LOCK","wb");
    flock($lock,LOCK_EX);

    unlink('../pending/'.$_GET['delete']);

    flock($lock,LOCK_UN);
    fclose($lock);
  }
}

if (isset($_GET['accept'])) {
  if ((substr($_GET['accept'],0,1)!='.') &&
      (substr($_GET['accept'],0,1)!='/')) {

    if (!file_exists('../locale/'.substr($_GET['accept'],0,2).'/LC_MESSAGES')) {
mkdir("../locale/".substr($_GET['accept'],0,2));
mkdir("../locale/".substr($_GET['accept'],0,2).'/LC_MESSAGES');
chmod(0777, "../locale/".substr($_GET['accept'],0,2));
chmod(0777, "../locale/".substr($_GET['accept'],0,2).'/LC_MESSAGES');

      //We can't even test if mkdir works from PHP because it always
      //returns true in safe mode, so we just FTP in the change
//      $conn = ftp_connect("article31.org");
//      ftp_login($conn,"article31","jpPPGNcC");
//      ftp_mkdir($conn,"html/locale/".substr($_GET['accept'],0,2));
//     ftp_mkdir($conn,"html/locale/".substr($_GET['accept'],0,2).'/LC_MESSAGES');
//      ftp_close($conn);
    }
    $lock = fopen("../pending/LOCK","wb");
    flock($lock,LOCK_EX);
    
    if (@copy('../pending/'.$_GET['accept'],'../locale/'.substr($_GET['accept'],0,2).'/LC_MESSAGES/messages.po'))
      unlink('../pending/'.$_GET['accept']);
/*    else {
      $conn = ftp_connect("article31.org");
      if ($conn && ftp_login($conn,"article31","jpPPGNcC")) {
	if (ftp_put($conn,"html/locale/".substr($_GET['accept'],0,2).'/LC_MESSAGES/messages.po','../pending/'.$_GET['accept'],FTP_BINARY))
	  unlink('../pending/'.$_GET['accept']);
	ftp_close($conn);
      }	
    }*/
    flock($lock,LOCK_UN);
    fclose($lock);
  }  
}

if (isset($_GET['view'])) {
  if ((substr($_GET['view'],0,1)!='.') &&
      (substr($_GET['view'],0,1)!='/')) {
    header("Content-Type: text/plain; charset=utf-8");
    $lock = fopen("../pending/LOCK","wb");
    flock($lock,LOCK_EX);
    echo file_get_contents('../pending/'.$_GET['view']);
    flock($lock,LOCK_UN);
    fclose($lock);
  }

} else {
  //  draw_header();
  admin_process_translations();
  //  draw_footer();
}
