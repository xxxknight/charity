<?php
$mysql = mysqli_connect("localhost","root","");//the database connection
if(!$mysql){
	echo "Fail to connect database.";
	exit;
}

$selected = mysqli_select_db($mysql, "project");
if(!$selected) {
	echo "Can not select properly.";
	exit;

}

?>