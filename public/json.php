<?php

$content = json_decode(file_get_contents("filename.json"));

mysql_connect('localhost', 'user', 'pass');
mysql_select_db('db');

foreach($content as $item) {
	$columns = implode(", ",array_keys($item));
	$escaped_values = array_map('mysql_real_escape_string', array_values($item));
	$values  = "'".implode("', '", $escaped_values)."'";
	$sql = "INSERT INTO `tbl_name`($columns) VALUES ($values)";
	mysql_query($sql);
}

?>