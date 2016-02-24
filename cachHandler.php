<?php
$mysql_hostname = "mysql15.000webhost.com";
    $mysql_user = "a6204434_bikram";
    $mysql_password ="bikram";
    $mysql_database ="a6204434_laundry";
    $connection = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("Could not connect database");
if(isset($_POST['query'])){
	$query = trim($_POST['query']);
	$qtype = trim($_POST['qtype']);
	if(isset($_POST['data'])){
	$data = $_POST['data'];
	$ExpDate = strtotime("+1 week");
	$sql_query = "INSERT INTO `".$qtype."`(`date`, `data`, `query`) VALUES ('".$ExpDate."','".$data."','".$query."')";
	$result = mysqli_query($connection,$sql_query);
	echo mysqli_error($connection);
	$cach_id = mysqli_insert_id($connection);
	echo $cach_id;
    }
    else{
	$sql_query = "SELECT * FROM `".$qtype."` WHERE `query`='".$query."'";
	$result = mysqli_query($connection,$sql_query);
	echo mysqli_error($connection);
	if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_assoc($result);
	$current_time = time();
	$query_time = $row['date'];
	if($current_time < $query_time) echo $row['data']."@shit";
    else{
	$sql_query = "DELETE FROM `".$qtype."` WHERE `query`='".$query."'";
    echo "#";	
	}
    }
	else echo "#";
    }
}
else header("location:registration.php");
?>