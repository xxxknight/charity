<?php

/*连接数据库*/
$DB_Server = "localhost";
$DB_Username = "root";
$DB_Password = "";
$DB_DBName = "project";  //目标数据库名

$Connect = mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect.");
$ALT_Db = mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database");
mysql_query("Set Names 'utf8'");
?>