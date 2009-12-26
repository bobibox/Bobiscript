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
?>