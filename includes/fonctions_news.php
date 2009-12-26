<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2009
 */

function RecupNews($template){
	$retour = mysql_query('SELECT * FROM news ORDER BY id DESC LIMIT 0, 5');
	while ($row = mysql_fetch_array($retour)){
		$template->assign_block_vars('news',array(
			'Titre' => $row['titre'],
			'Contenu'  => $row['contenu'],
			'Date' => date('d/m/Y', $row['date']),
			'Pseudo' => $row['pseudo']
		));
	}
}
?>