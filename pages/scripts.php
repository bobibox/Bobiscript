<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2009
 */

$template->set_filenames(array('scripts' => 'scripts.tpl'));

if(!empty($_GET['view'])){
	$result = AffichageScript($_GET['view']);
}
else{
	$result = ScanDirectory('fichiers/scripts');
}

$template->assign_vars(array(
'SCRIPTS' =>		$result
));
$template->assign_var_from_handle('CONTENU', 'scripts');
?>