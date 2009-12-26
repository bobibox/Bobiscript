<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2009
 */

function connect($DBHost,$DBUser,$DBPass,$DBTable){
	$connect = mysql_connect($DBHost, $DBUser, $DBPass);
	mysql_select_db($DBTable, $connect);
}
?>