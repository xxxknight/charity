<?php 
include 'design/database.php';
$DB_DBName = "project";
$DB_TBLName = "userinfo";  //目标表名
$savename = date("YmjHis"); //导出excel文件名
$file_type = "vnd.ms-excel"; 
$file_ending = "xls"; 
header("Content-Type: application/$file_type;charset=utf8"); 
header("Content-Disposition: attachment; filename=".$savename.".$file_ending"); 
//header("Pragma: no-cache"); 

/*写入备注信息*/
$now_date = date("Y-m-j"); 
$title = "DATABASE-NAME:$DB_DBName,DATA-TABLE:$DB_TBLName,RESTORE-DATE:$now_date"; 
echo("$title\n"); 

/*查询数据库*/

$sql = "Select * from $DB_TBLName"; 
$result = @mysql_query($sql,$Connect) or die(mysql_error()); 

/*写入表字段名*/
echo "here to write more";
for ($i = 0; $i < mysql_num_fields($result); $i++) { 
 echo mysql_field_name($result,$i) . "\t"; 
} 
echo "\n";
echo "22222";

/*写入表数据*/
$sep = "\t"; 
while($row = mysql_fetch_row($result)) { 
 $data = ""; 
  for($i=0; $i<mysql_num_fields($result);$i++) { 
   if(!isset($row[$i])) 
    $data .= "NULL".$sep; //处理NULL字段
   elseif ($row[$i] != "") 
    $data .= "$row[$i]".$sep; 
   else 
    $data .= "".$sep; //处理空字段
  } 
 echo $data."\n"; 
}
?>
