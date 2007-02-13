{literal}

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
var hash = '';
var torrent_name = '';
var upload_error = '';

var pollTimer;

function popUp(URL) {
	day = new Date();
	id = day.getTime();

	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=640,height=600');");

}

function start_polling() {
	if (hash == '') {
		pollTimer = setTimeout('start_polling()', 500);
	} 
	else {
		do_poll();
	}
}

function do_poll() {
	window.frames['poll'].location = 'poll.php?i=' + hash;

	if (torrent_name == "" && upload_error == "" ) {
		pollTimer = setTimeout('do_poll()',5000);
	} 
	else if ( upload_error != "" ) {
		document.getElementById('video_blurb').innerHTML = '<div style="color: #A00;">There was an error in the upload process:<br />' + upload_error + '</div>';
	}
	else {
		document.getElementById('video_blurb').innerHTML = '<div style="color: #A00;">Now sharing "' + torrent_name + '".<br /> <strong>You must keep the BM Helper window open for this file to remain available.</strong></div>';
	}
}


function upload() {
  
    if (hash != '') {
      hash = '';
      torrent_name = '';
    }

    window.frames['uploader'].location = 'trigger.php';
    pollTimer = setTimeout('start_polling()', 500 );
document.getElementById('server_sharing').style.display = 'block';
}



function isFull() {

	frm = document.getElementById('post');

	if (document.getElementById('people_table').rows.length > 2) {
		var do_add = true;

		for( i = 0; i < frm.People_name.length; i++ ) {

			if ( frm.People_name[i].value == '' || 
					frm.People_role[i].value == '' ) {
				do_add = false;
				break;
			}
		}

		if (do_add) {
			addPeople();
		}

	} 
	else {

		if (frm.People_name.value != '' && frm.People_role.value != '') {
			addPeople();
		}
	}

}

function clearPeople() {

	// this is the div that holds the table of people
	oDiv = document.getElementById('people_holder');

	// delete the inner table from the div
	oDiv.removeChild(oDiv.firstChild);
	
	// recreate the table
	oDiv.innerHTML = '<table cellpadding="2" cellspacing="0" border="0" id="people_table"><tr><td width="200">&nbsp;</td><td width="200">&nbsp;</td></tr></table>';

	// add the 1st blank back
//	addPeople();
}

function addPeople() {
	addPerson("", "");
}

function addPerson(name, role) {

	lyr = document.getElementById('people_table');

	var oNewRow = lyr.insertRow(-1);
	var oNewCell1 = document.createElement("td");
	var oNewCell2 = document.createElement("td");

	oNewRow.appendChild(oNewCell1);
	oNewRow.appendChild(oNewCell2);

	oNewCell1.innerHTML = '<input type="text" id="person" name="People_name" value="' + name + '" onKeyDown="isFull();"/>';
	oNewCell2.innerHTML = '<input type="text" id="person" name="People_role" value="' + role + '" onKeyDown="isFull();"/>';

}



function do_submit(frm) {

	var err = '';
	if ( hash == '' && frm.ID.value != '' ) {
		hash = frm.ID.value;
	}

	if (hash != '' && (frm.URL.value == '' || frm.URL.value == 'http://') ) {
		frm.URL.value = hash;
		frm.Mimetype.value = 'application/x-bittorrent';
	} 
	
  if (
		(frm.URL.value == '' || frm.URL.value == 'http://') &&
		frm.post_file_upload.value == ''	) {
		err = 'Please enter a file location or upload a file';
	}
	
	if ( frm.Title.value == '' ) {
		err = 'Please enter a title';
	}

	// clear out the values of the form widgets that aren't visible, so their data isn't stored as the file info
/*	if ( document.getElementById('upload_file').style.display == 'block' ) {
		document.getElementById('specify_url').value = '';
		frm.URL.value = '';
		frm.post_use_upload.value = 1;
	}
	else if ( document.getElementById('specify_url').style.display == 'block' ) {
//		document.getElementById('upload_file').value = '';
		frm.post_use_upload.value = 0;
	}
*/

	var channel_count = 0;

  for (i=0; i < document.post.length; i++) {
    if (document.post[i].name == 'post_channels[]') {
      if ( document.post[i].checked == true ) {
      			channel_count++;
      }
    }
  }

	//
	// cjm - ask the user if they want to select a channel before saving
	//	
	if ( channel_count == 0 ) {
		var channel_go = confirm("You haven't selected a channel - Would you like to continue anyway?");
		if ( channel_go == false ) {
			return false;
		}		
	}

	frm.People.value = '';

	if ( document.getElementById('people_table').rows.length > 2 ) {

		for( i=0; i < frm.People_name.length; i++ ) {
			if ( frm.People_name[i].value != '' && frm.People_role[i].value != '' ) {
        //&& trim(frm.People_name[i].value) != '' && trim(frm.People_role[i].value) != '' 
				frm.People.value += frm.People_name[i].value + ':' + frm.People_role[i].value + '\n';
			}
		}

	} 
	else {
    if ( frm.People_name.value != '' && frm.People_role.value != '' ) {
      // && trim(frm.People_name.value) != null && trim(frm.People_role.value) != null
		  frm.People.value = frm.People_name.value + ':' + frm.People_role.value;
	  }
	}

//	frm.post_channel_array.value = channel_array.join(',');

	if (err == '') {

/*		if ( document.getElementById('upload_file').style.display == 'block' ) {
			document.getElementById('progress_bar').style.display = 'block';
			document.getElementById('progress_bar2').style.display = 'block';
		}
*/
		return true;
	} 

	alert(err);
	return false;
}

function submit_force() {
	frm = document.getElementById('post');
	frm.ignore_mime.value = 1;
	if ( do_submit(frm) ) {
		frm.submit();
	}
}



// End -->
</script>

<SCRIPT LANGUAGE="JavaScript">

	function autofill(id) {
		clearPeople();
		frm = document.getElementById("post");

    if ( id == "" ) {
     frm.reset();
     addPeople();
    } else {
	
{/literal}
		//frm.Creator.value = "{$testvideo.name}";
		frm.Creator.value = "{$allvideos[id].creator}";			
{literal}
		frm.donation_id.value = "";
		frm.Rights.value = "";
		frm.Keywords.value = "";
		frm.Webpage.value = "";
		frm.Explicit.checked = false;
		addPeople();
	
	}
}
		
</script>
{/literal}



