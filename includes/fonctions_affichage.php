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

function AffichageSource($type, $lang, $nom){
        if(preg_match("#^../#", $nom) == TRUE){
                $result = "Erreur lors du chargement du script";
        }
        else{
            $language = str_replace('.','',strstr($nom, '.'));
            $source = '';
            $script =  'fichiers/'.$type.'/'.$lang.'/'.$nom;
            if (file_exists($script)){
        	    $contenu = file($script);
               	    while(list($cle,$val) = each($contenu)) {
                        	$source .= $val;
                    }
            }
            $geshi = new GeSHi($source, $language);
            $geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
            $geshi->set_overall_style('font-size:11px;width:580px;', true);
            $geshi->set_line_style('background: #fcfcfc;', 'background: #f0f0f0;');

            $result = $geshi->parse_code();
        }
        $result .= '<div align=center><a href="?page='.$type.'">Retour</a></div>';
	return $result;
}


/* Fonction prise sur : */
function ScanDirectory($Directory){
$result = '';
$MyDirectory = opendir('fichiers/'.$Directory) or die("Impossible d'ouvrir le dossier");
while($Entry = @readdir($MyDirectory)) {
	if(is_dir('fichiers/'.$Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
		$result .= '<h3>'.$Entry.'</h3>';
		$result .= ScanDirectory($Directory.'/'.$Entry);
	}
	elseif($Entry != '.' && $Entry != '..'){
                $lang =  str_replace('/','',strstr($Directory, '/'));
		$result.= '<p><a href="'.$_SERVER['REQUEST_URI'].'&lang='.$lang.'&name='.$Entry.'">'.$Entry.'</a></p>';
	}
}
return $result;
closedir($MyDirectory);
}

?>