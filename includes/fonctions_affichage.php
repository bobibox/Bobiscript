<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2009
 */


function RecupMenu($template){
	$retour = mysql_query('SELECT * FROM menu ORDER BY place');
	while ($row = mysql_fetch_array($retour)){
		$template->assign_block_vars('menu',array(
			'Page' => $row['page'],
		));
	}
}

function AffichageScript($script){
	$language = str_replace('.','',strstr($script, '.'));
	$source = '';
	if (file_exists($script)){
		$contenu = file($script);
		while(list($cle,$val) = each($contenu)) {
			$source .= $val;
		}
	}
	$geshi = new GeSHi($source, $language);
	$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
        $geshi->set_overall_style(';width:580px;', true);
	$geshi->set_line_style('background: #fcfcfc;', 'background: #f0f0f0;');

	$result = $geshi->parse_code();
	return $result;
}


/* Fonction prise sur : */
function ScanDirectory($Directory){
$result = '';
$MyDirectory = opendir($Directory) or die('Erreur');
while($Entry = @readdir($MyDirectory)) {
	if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
		$result.= '<h3>'.$Entry.'</h3>';
		$result .= ScanDirectory($Directory.'/'.$Entry);
	}
	elseif($Entry != '.' && $Entry != '..'){
		$result.= '<p><a href="'.$_SERVER['REQUEST_URI'].'&view='.$Directory.'/'.$Entry.'">'.$Entry.'</a></p>';
	}
}
return $result;
closedir($MyDirectory);
}

?>