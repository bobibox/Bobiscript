<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2009
 */


require_once('config.php');
require_once('common.php');
require_once('includes/template.php');
require_once('includes/geshi.php');

connect($DBHost,$DBUser,$DBPass,$DBTable);

$template = new Template('themes/'.$DESIGN.'/templates');


/* Declaration du haut et du bas de page, ainsi que de leurs variables */
$template->set_filenames(array(
	'header' => 'header.tpl',
	'footer' => 'footer.tpl'
));

$template->assign_vars(array(
	'TITRE' =>		$SiteName,
	'CSS' => 'themes/'.$DESIGN.'/style.css',
	'SUBTITRE' =>	$Slogan,
	'COPYRIGHT' => $Copyright
));

/* Affichage du haut de page */
$template->pparse('header');

/* Declaration et affichage du menu, ainsi que de ses variables */
$template->set_filenames(array('menu' => 'menu.tpl'));
RecupMenu($template);
$template->pparse('menu');

$template->set_filenames(array('index' => 'index.tpl'));
/* Affichage du contenu de la page */
if((!empty($_GET['page'])) AND ($_GET['page'] != 'index')){
	include('pages/'.$_GET['page'].'.php');
}
else{
	$template->set_filenames(array('news' => 'news.tpl'));
	RecupNews($template);
	$template->assign_var_from_handle('CONTENU', 'news');
}

/* Affichage du contenu */
$template->pparse('index');
/* Affichage du pied de page */
$template->pparse('footer');
?>