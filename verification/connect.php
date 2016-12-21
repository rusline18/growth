<?php 
	$host='localhost';
	$db='my';
	$user_mysql='root';
	$pass_mysql='';
	$link=mysql_connect($host, $user_mysql, $pass_mysql) or die("<center><h1>Don't connect with database!!!</h1></connect>");
	mysql_query("set character_set_client='utf8'");
	mysql_query("set character_set_results='utf8'");
	mysql_query("set collation_connecrion='utf8_general_ci'");
	mysql_select_db($db, $link) or die("<center><h1>ERROR CONNECT DATABASE!!!</h1></center>");
?>
