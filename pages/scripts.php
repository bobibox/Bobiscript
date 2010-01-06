<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2009
 */
$template->set_filenames(array('scripts' => 'scripts.tpl'));

if(!empty($_GET['lang']) AND !empty($_GET['name'])){
	$result = AffichageSource('scripts',$_GET['lang'],$_GET['name']);
}
else{
	$result = ScanDirectory('scripts');
}

$template->assign_vars(array(
'SCRIPTS' =>	$result
));
$template->assign_var_from_handle('CONTENU', 'scripts');
?>