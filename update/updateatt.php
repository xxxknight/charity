<?php
include '../dbin.php';
$query = "SELECT max(Id) from userinfo";

$result = mysqli_query($mysql,$query);
if($result == "") {
	echo " fail to query.";
	exit;
}

$row=mysqli_fetch_array($result);

	$time=$_POST['time'];
	//echo $time;
	
	//$column = $time;
	//echo $column;
	//$sql="alter table ucomeback add $column varchar(10)";
	//$res = mysqli_query($mysql,$sql);
	//if($res)
	//	echo 'success';
	//else echo 'failure';
	
	 //将数据插入action表格中
	 //echo $time;
	$i=0;
	$g=0;
	while ($i<$row[0]){
			if(isset($_POST[$i])){
				$sql = "SELECT flag from action where insertmonth ='". $time ."' and userid = $i";
				
				$result = mysqli_query($mysql,$sql);
				if($result == "") {
					echo " fail to query1.";
					$g=1;
					exit;
				}
				$num_rows = mysqli_fetch_array($result);
				if($num_rows != null){
				
					?> <input type ="hidden"  id= "number" value= <?php echo $i ;?> >
									<script>
								     alert("client"+document.getElementById("number").value+"has attend already, please check first.");
									</script>
								<?php 
							}
			else{
			$value=$_POST[$i];
			if($value == "M"){
				$sql="INSERT into action (userid,flag,insertmonth,isfirst) value ('$i','M','$time','F')";
				$result = mysqli_query($mysql,$sql);
				if($result == "") {
					echo " fail to query1.";
					$g=1;
					exit;
				}
				}
			if($value == "E"){
				$sql="INSERT into action (userid,flag,insertmonth,isfirst) value ('$i','E','$time','F')";
				$result = mysqli_query($mysql,$sql);
				if($result == "") {
					echo " fail to query2.";
					$g=1;
					exit;
				}
				}
			if($value == "O"){
				$sql="INSERT into action (userid,flag,insertmonth,isfirst) value ('$i','M','$time','T')";
				$result = mysqli_query($mysql,$sql);
				if($result == "") {
					echo " fail to query3.";
					$g=1;
					exit;
				}
				$sql="update userinfo set newin= '$time' where Id=$i";
				$result = mysqli_query($mysql,$sql);
				if($result == "") {
					echo " fail to query4.";
					$g=1;
					exit;
				}
				
				}
				}
			}
			$i++;
			
	}
	
	

if ($g!=1){ $ff="back";}
else { $ff="fail";}
?>
<input type="hidden" id="success" name="success" value="<?php echo $ff ;?>">
<script>
 if( document.getElementById("success").value=="back"){
	 alert("Update success,now jumpping back to the previous page.");
	 location="../functionpage.php";
	 }
 else {
	 alert("Update success,now jumpping back to the previous page.Please try again.");
	 location="updateattend.php";
	 }
</script>