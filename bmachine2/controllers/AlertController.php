<?php

class AlertController{
	function AlertController(){}
	
	function emitError($message){
		global $smarty;
		$smarty->assign('message', $message);
		$smarty->display('error.tpl');
	}
}

?>
