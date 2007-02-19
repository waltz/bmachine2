<?php

class ErrorController{
	function ErrorController(){}
	
	function emitError($message){
		global $smarty;
		$smarty->assign('message', $message);
		$smarty->display('error.tpl');
	}
}

?>
