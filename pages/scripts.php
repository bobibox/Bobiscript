<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2009
 */

$template->set_filenames(array('scripts' => 'scripts.tpl'));
/*
   Action à faire
*/
$template->assign_var_from_handle('CONTENU', 'scripts');
?>