{* Smarty *}


<!-- BASIC PUBLISHING OPTIONS -->
<div class="wrap">
<form name="post" action="publish.php" method="post" id="post" 
		onLoad="this.reset();" onSubmit="return do_submit(this);" enctype="multipart/form-data" 
		accept-charset="utf-8">

	<input type="hidden" name="ignore_mime" class="hidden" value="0" />
	<input type="hidden" name="post_do_save" class="hidden" value="1" />
	<input type="hidden" name="Mimetype" value="" class="hidden">
	<input type="hidden" name="People" class="hidden" />
	<input type="hidden" name="ID" class="hidden" value=""/>


<div id="poststuff">

<div class="page_name">
   <h2>Publish a File</h2>

   <div class="help_pop_link">
      <a href="javascript:popUp('http://www.getdemocracy.com/broadcast/help/publish_popup.php')">
<img src="themes/default/images/help_button.gif" alt="help"/></a>

   </div>
</div>


<div class="section">
<fieldset id="video_file">
	<input type="hidden" name="post_use_upload" class="hidden" value="1" />
  <input type="hidden" name="URL" value="http://" class="hidden">
	<h3>Upload a File</h3>

	<div id="upload_file">
	<input type="file" name="post_file_upload" value="Choose File" /><br />
	<p style="font-size: 11px; margin-bottom: 0px; padding-bottom: 0px;">
	<strong>Note:</strong> Uploading files with your browser can take several minutes or longer, 
	depending on the file size.  The file upload will begin when you click "Publish".  Please be patient 
	and do not touch the browser while your file is uploading.  Also be aware that servers sometimes have 
	a limit on the maximum size of an uploaded file.  For files larger than 2 or 3 megabytes, we generally 
	recommend either posting a torrent or using an FTP program and then linking to the file.<br /><br />
	The maximum upload size of this server is <strong>2M</strong>.
	</p>
	</div>

</fieldset>

<fieldset id="video_blurb">
	</fieldset>
</div>


<div class="section">

<fieldset id="channel_selection">
	<legend>Publish to These Channels</legend>
   <ul>
{* for *}
<li><input type=checkbox name="post_channels[]" value="{$value}" /> {$channels}<br/>
{* end for *}
	    </ul>
</fieldset>


<fieldset>
<div class="the_legend">Title: </div><br /><input type="text" name="Title" size="38" value=""/>
</fieldset>

<fieldset>
       <div class="the_legend">Description (optional):</div><br /><textarea rows="4" cols="38" name="Description"></textarea>

</fieldset>

<fieldset><div class="the_legend">Thumbnail (optional): </div>
<a href="#" onClick="document.getElementById('specify_image').style.display = 'none'; document.getElementById('upload_image').style.display = 'block'; return false;">Upload Image</a> or <a href="#" onClick="document.getElementById('upload_image').style.display = 'none'; document.getElementById('specify_image').style.display = 'block'; return false;">Specify URL</a>

<div style="display:none;" id="upload_image">
<input type="file" name="Image_upload" value="Choose Image" />
</div>


<div id="specify_image" style="display:none;" >

<input type="text" name="Image" size="40" value="http://"/>

</div>
</fieldset>

<fieldset><img src="themes/default/images/cc_logo_17px.png" alt="CC logo" /> Creative Commons (optional): <input type="text" name="LicenseName" size="38" value="" onFocus="this.blur();" autocomplete="off" class="blended"/><br/>

<a href="#" onClick="window.open('http://creativecommons.org/license/?partner=bmachine&exit_url=' + escape('http://localhost/vegworcester-css/bm/cc.php?license_url=[license_url]&license_name=[license_name]'),'cc_window','scrollbars=yes,status=no,directories=no,titlebar=no,menubar=no,location=no,toolbar=no,width=450,height=600'); return false;">Choose License</a>

<input type="hidden" name="LicenseURL" value="" class="hidden"/>

</fieldset>
</div>

<p class="publish_button" style="clear: both;">
<input id="publish_button" style="border: 0px solid black;" type="image" src="./images/publish_button.gif" border=0 alt="Continue" />
</p>

<div class="section optional">
<div class="section_header">Optional: Additional Information</div>

		<fieldset id="auto_fill">
		<legend>Auto Fill</legend>
		<div style="font-size: 12px; line-height: 15px;">Automatically fill in these information fields with info from a previously published video:</div>

<select name="videos" onChange="autofill(this.options[this.selectedIndex].value);" ><option value=""></option>
<option value="0ce68fd83102a64b5decc96bb2bb6f67514f295d">test video 1</option><option value="bbfcfbe30df9d94317de8d3f064cbd2a37bd90a8">test 3</option><option value="eb634e3557a78fab01c56870d7a79b9d488a84fe">test 2</option></select>	
		</fieldset>

    <fieldset>
      <div class="the_legend">
			Creator (can be multiple or an organization)
			</div><br />

			<input type="text" name="Creator" size="40" value=""/>
    </fieldset>

    <fieldset>
      <div class="the_legend">Associated Donation Setup:</div> 

<select name="donation_id">
<option value="">(none)</option>
</select>

    </fieldset>

    <fieldset>
      <div class="the_legend">Copyright Holder (if different than creator)</div>
			<br />
			<input type="text" name="Rights" size="40" value=""/>
    </fieldset>

    <fieldset>
      <div class="the_legend">Keywords / Tags (1 per line)</div>

			<br/>
			<textarea name="Keywords" rows="4" cols="38">
</textarea>
    </fieldset>

<fieldset style="clear:both" id="postdiv">
       <div class="the_legend">People Involved:</div>
<div id="people_header"><table cellpadding="2" cellspacing="0" border="0">
	<tr>
		<td width="200"><font class="the_legend">Name</font></td>

		<td width="200"><font class="the_legend">Role</font></td>
	</tr>
	</table>
</div>

<div id="people_holder"><table cellpadding="2" cellspacing="0" border="0" id="people_table">
	<tr>
		<td width="200">&nbsp;</td>
		<td width="200">&nbsp;</td>
	</tr>

	<tr>
		<td><input type="text" name="People_name" value="" onKeyDown="isFull();"/></td>
		<td><input type="text" name="People_role" value="" onKeyDown="isFull();"/></td>
	</tr>
</table>
</div>
</fieldset>

<fieldset style="clear:both" id="postdiv">

<div class="the_legend">
<a href="#" onClick="document.getElementById('transcript_upload').style.display = 'none'; document.getElementById('transcript_url').style.display = 'none'; document.getElementById('transcript_text').style.display = 'block'; return false;" style="font-weight:normal;">Enter Transcript Text</a> <em>or</em> <a href="#" onClick="document.getElementById('transcript_text').style.display = 'none'; document.getElementById('transcript_url').style.display = 'none'; document.getElementById('transcript_upload').style.display = 'block'; return false;">Upload text file</a> <em>or</em> <a href="#" onClick="document.getElementById('transcript_upload').style.display = 'none'; document.getElementById('transcript_text').style.display = 'none'; document.getElementById('transcript_url').style.display = 'block'; return false;">Specify URL</a>

</div>

<div id="transcript_text">

<textarea rows="3" cols="40" 
	name="post_transcript_text"></textarea>
</div>

<div id="transcript_upload" style="display:none;">
<input type="file" name="post_transcript_file"/>
</div>

<div id="transcript_url" style="display:none;">

<input type="text" name="Transcript" size="40" value=""/>
</div>
</fieldset>

<fieldset>
  <div class="the_legend">Associated Webpage </div>
	<br />
	<input type="text" name="Webpage" size="40" value=""/>
</fieldset>


<fieldset>Release Date
<div class="input_sub">
Day: <select name="ReleaseDay">
	<option value=""></option>

<option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option><option value=5>5</option><option value=6>6</option><option value=7>7</option><option value=8>8</option><option value=9>9</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19>19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option><option value=24>24</option><option value=25>25</option><option value=26>26</option><option value=27>27</option><option value=28>28</option><option value=29>29</option><option value=30>30</option><option value=31>31</option></select>

&nbsp;&nbsp;Month: <select name="ReleaseMonth">
	<option value=""></option>

<option value=0>January</option><option value=1>February</option><option value=2>March</option><option value=3>April</option><option value=4>May</option><option value=5>June</option><option value=6>July</option><option value=7>August</option><option value=8>September</option><option value=9>October</option><option value=10>November</option><option value=11>December</option></select>

&nbsp;&nbsp;Year: <input type="text" name="ReleaseYear" size="4" maxlength="5" value=""/>

</div>
</fieldset>

<fieldset>
Play Length

<div class="input_sub">
Hours: <input type="text" name="RuntimeHours" size="2" value=""/> Minutes: <select name="RuntimeMinutes">
	<option value=""></option>
<option value=00>00</option><option value=01>01</option><option value=02>02</option><option value=03>03</option><option value=04>04</option><option value=05>05</option><option value=06>06</option><option value=07>07</option><option value=08>08</option><option value=09>09</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19>19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option><option value=24>24</option><option value=25>25</option><option value=26>26</option><option value=27>27</option><option value=28>28</option><option value=29>29</option><option value=30>30</option><option value=31>31</option><option value=32>32</option><option value=33>33</option><option value=34>34</option><option value=35>35</option><option value=36>36</option><option value=37>37</option><option value=38>38</option><option value=39>39</option><option value=40>40</option><option value=41>41</option><option value=42>42</option><option value=43>43</option><option value=44>44</option><option value=45>45</option><option value=46>46</option><option value=47>47</option><option value=48>48</option><option value=49>49</option><option value=50>50</option><option value=51>51</option><option value=52>52</option><option value=53>53</option><option value=54>54</option><option value=55>55</option><option value=56>56</option><option value=57>57</option><option value=58>58</option><option value=59>59</option>

</select> Seconds: <select name="RuntimeSeconds">

	<option value=""></option>

<option value=00>00</option><option value=01>01</option><option value=02>02</option><option value=03>03</option><option value=04>04</option><option value=05>05</option><option value=06>06</option><option value=07>07</option><option value=08>08</option><option value=09>09</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19>19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option><option value=24>24</option><option value=25>25</option><option value=26>26</option><option value=27>27</option><option value=28>28</option><option value=29>29</option><option value=30>30</option><option value=31>31</option><option value=32>32</option><option value=33>33</option><option value=34>34</option><option value=35>35</option><option value=36>36</option><option value=37>37</option><option value=38>38</option><option value=39>39</option><option value=40>40</option><option value=41>41</option><option value=42>42</option><option value=43>43</option><option value=44>44</option><option value=45>45</option><option value=46>46</option><option value=47>47</option><option value=48>48</option><option value=49>49</option><option value=50>50</option><option value=51>51</option><option value=52>52</option><option value=53>53</option><option value=54>54</option><option value=55>55</option><option value=56>56</option><option value=57>57</option><option value=58>58</option><option value=59>59</option>

</select>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="Excerpt"/> This is an excerpt of a longer piece.

</div>
</fieldset>


<fieldset><input type="checkbox" name="Explicit"> Contains explicit content (some search services filter based on this).
</fieldset>

<fieldset>
Create Date

<div class="input_sub">
Will be set to the timestamp of the first time that publish the file.  
<a href="#" onClick="document.getElementById('create_time').style.display = 'block'; return false;">Manually Edit Create Date</a>
</div>

<div id="create_time" style="display:none;">
<select name="post_create_day">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5" selected>5</option>
<option value="6">6</option>
<option value="7">7</option>

<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>

<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>

<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>

<select name="post_create_month">
<option value=0>January</option><option value=1 selected="true">February</option><option value=2>March</option><option value=3>April</option><option value=4>May</option><option value=5>June</option><option value=6>July</option><option value=7>August</option><option value=8>September</option><option value=9>October</option><option value=10>November</option><option value=11>December</option></select>

<select name="post_create_year">
<option value=2005>2005</option><option value=2006>2006</option><option value=2007 selected="true">2007</option><option value=2008>2008</option><option value=2009>2009</option><option value=2010>2010</option><option value=2011>2011</option><option value=2012>2012</option><option value=2013>2013</option><option value=2014>2014</option><option value=2015>2015</option><option value=2016>2016</option><option value=2017>2017</option><option value=2018>2018</option><option value=2019>2019</option><option value=2020>2020</option><option value=2021>2021</option><option value=2022>2022</option><option value=2023>2023</option><option value=2024>2024</option><option value=2025>2025</option></select> @


<select name="post_create_hour">
<option value=0>0</option><option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option><option value=5>5</option><option value=6>6</option><option value=7>7</option><option value=8>8</option><option value=9>9</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19 selected="true">19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option></select>:<select name="post_create_minute">

<option value=00>00</option><option value=01>01</option><option value=02>02</option><option value=03>03</option><option value=04>04</option><option value=05>05</option><option value=06>06</option><option value=07>07</option><option value=08>08</option><option value=09>09</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19>19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option><option value=24>24</option><option value=25>25</option><option value=26>26</option><option value=27>27</option><option value=28>28</option><option value=29 selected="true">29</option><option value=30>30</option><option value=31>31</option><option value=32>32</option><option value=33>33</option><option value=34>34</option><option value=35>35</option><option value=36>36</option><option value=37>37</option><option value=38>38</option><option value=39>39</option><option value=40>40</option><option value=41>41</option><option value=42>42</option><option value=43>43</option><option value=44>44</option><option value=45>45</option><option value=46>46</option><option value=47>47</option><option value=48>48</option><option value=49>49</option><option value=50>50</option><option value=51>51</option><option value=52>52</option><option value=53>53</option><option value=54>54</option><option value=55>55</option><option value=56>56</option><option value=57>57</option><option value=58>58</option><option value=59>59</option></select>

</div>
</fieldset>


<fieldset>
Timestamp

<div class="input_sub">
Will be set to the time that you press 'publish'. 
<a href="#" onClick="document.getElementById('publish_time').style.display = 'block'; return false;">Manually Edit Timestamp</a>
</div>

<div id="publish_time" style="display:none;">
<select name="post_publish_day">
<option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option><option value=5 selected="true">5</option><option value=6>6</option><option value=7>7</option><option value=8>8</option><option value=9>9</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19>19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option><option value=24>24</option><option value=25>25</option><option value=26>26</option><option value=27>27</option><option value=28>28</option><option value=29>29</option><option value=30>30</option><option value=31>31</option></select>

<select name="post_publish_month">
<option value=0>January</option><option value=1 selected="true">February</option><option value=2>March</option><option value=3>April</option><option value=4>May</option><option value=5>June</option><option value=6>July</option><option value=7>August</option><option value=8>September</option><option value=9>October</option><option value=10>November</option><option value=11>December</option></select>

<select name="post_publish_year">

<option value=2005>2005</option><option value=2006>2006</option><option value=2007 selected="true">2007</option><option value=2008>2008</option><option value=2009>2009</option><option value=2010>2010</option><option value=2011>2011</option><option value=2012>2012</option><option value=2013>2013</option><option value=2014>2014</option><option value=2015>2015</option><option value=2016>2016</option><option value=2017>2017</option><option value=2018>2018</option><option value=2019>2019</option><option value=2020>2020</option><option value=2021>2021</option><option value=2022>2022</option><option value=2023>2023</option><option value=2024>2024</option><option value=2025>2025</option></select> @


<select name="post_publish_hour">
<option value=0>0</option><option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option><option value=5>5</option><option value=6>6</option><option value=7>7</option><option value=8>8</option><option value=9>9</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19 selected="true">19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option></select>:<select name="post_publish_minute">

<option value=00>00</option><option value=01>01</option><option value=02>02</option><option value=03>03</option><option value=04>04</option><option value=05>05</option><option value=06>06</option><option value=07>07</option><option value=08>08</option><option value=09>09</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19>19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option><option value=24>24</option><option value=25>25</option><option value=26>26</option><option value=27>27</option><option value=28>28</option><option value=29 selected="true">29</option><option value=30>30</option><option value=31>31</option><option value=32>32</option><option value=33>33</option><option value=34>34</option><option value=35>35</option><option value=36>36</option><option value=37>37</option><option value=38>38</option><option value=39>39</option><option value=40>40</option><option value=41>41</option><option value=42>42</option><option value=43>43</option><option value=44>44</option><option value=45>45</option><option value=46>46</option><option value=47>47</option><option value=48>48</option><option value=49>49</option><option value=50>50</option><option value=51>51</option><option value=52>52</option><option value=53>53</option><option value=54>54</option><option value=55>55</option><option value=56>56</option><option value=57>57</option><option value=58>58</option><option value=59>59</option></select>

</div>
</fieldset>
</div>

<p class="publish_button" style="clear: both;">
<input style="border: 0px solid black;" type="image" src="./images/publish_button.gif" border=0 alt="Continue" />
</p>

</div>
</form>

	<div class="spacer">&nbsp;</div>
	</body>
	</html>
