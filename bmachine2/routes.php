<?php 
// When parsing a URI, Broadcast Machine will check the url against the items in this list and re-route URIs
// depending on these rules

// Routes are in the form of:
// 'input_url'	=>	'redirect_url/[action]...'[,]
// Note that this only affects url parameters, or those that come after your baseURI, 
// and should not include leading or trailing slashes
$routes = array(	
	'users'		=>	'user',
	'videos'	=>	'video',
	'tags'		=>	'tag',
	'channels'	=>	'channel',
	//Routes can be used to call a controller and action from a single URL parameter:
	'signup'	=> 	'user/signup',
	'login'		=>	'user/login',
	'logout'	=>	'user/logout'
);

?>
