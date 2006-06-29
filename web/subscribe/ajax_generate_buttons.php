<?php
  $error_string = "";
  $subscription_url = "http://subscribe.getdemocracy.com/?";

  $urls_input = $_POST['urls'];

  if ($urls_input == null || $urls_input == '')
  {
    $error_string = "You need to enter at least one valid URL.  Please try again in the above field.";
  }
  else
  {
    $urls = explode('\n', $urls_input);
    $url_count = count($urls);

    
    for ($i = 1; $i <= $url_count; $i++)
    {
      $subscription_url .= "url" . $i . "=" . urlencode($urls[($i - 1)]);

      if ($i != $url_count)
      {
        $subscription_url .= "&";
      }
    }
  }

?>

<br /><Br />

<?php
  if ($error_string != "")
  {
?>

<p><strong>Error!</strong></p>

<p><?= $error_string ?></p>

<?php
  }
  else
  {
?>

<p><strong>Step 2. Pick the button you want to use and paste the code into your site.</strong></p>

<p>Subscribe URL: <a href="<?= $subscription_url ?>"><?= $subscription_url ?></a></p>

<div class="button">
			<div class="image"><img src="http://getdemocracy.com/buttons/img/88x31-02.jpg" alt="" /></div>
			<div class="code"><textarea name="code" cols="38" rows="4" style="background-color: #EEEEEE;"><a href="<?= $subscription_url ?>" title="Democracy: Internet TV"><img src="http://getdemocracy.com/buttons/img/88x31-02.jpg" alt="Democracy: Internet TV" border="0" /></a></textarea></div>
</div>

<div class="button">
			<div class="image"><img src="http://getdemocracy.com/buttons/img/88x31-02.jpg" alt="" /></div>
			<div class="code"><textarea name="code" cols="38" rows="4" style="background-color: #EEEEEE;"><a href="<?= $subscription_url ?>" title="Democracy: Internet TV"><img src="http://getdemocracy.com/buttons/img/88x31-02.jpg" alt="Democracy: Internet TV" border="0" /></a></textarea></div>
</div>

<div class="button">
			<div class="image"><img src="http://FireAnt.tv/files/images/sub_fireant.gif" alt="" /></div>
			<div class="code"><textarea name="code" cols="38" rows="4" style="background-color: #EEEEEE;"><a href="<?= $subscription_url ?>" title="Democracy: Internet TV"><img src="http://getdemocracy.com/buttons/img/88x31-02.jpg" alt="Democracy: Internet TV" border="0" /></a></textarea></div>
</div>

<div class="button">
			<div class="image"><img src="http://mefeedia.com/images/itunesmac.gif" alt="" /></div>
			<div class="code"><textarea name="code" cols="38" rows="4" style="background-color: #EEEEEE;"><a href="<?= $subscription_url ?>" title="Democracy: Internet TV"><img src="http://getdemocracy.com/buttons/img/88x31-02.jpg" alt="Democracy: Internet TV" border="0" /></a></textarea></div>
</div>

<?php
  }
?>
