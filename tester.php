<?php
$mysql_hostname = "mysql15.000webhost.com";
    $mysql_user = "a6204434_bikram";
    $mysql_password ="bikram";
    $mysql_database ="a6204434_laundry";
    
    $connection = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("Could not connect database");
	$query = "SELECT * FROM custom";
	$result = mysqli_query($connection,$query);
	$rows = mysqli_num_rows($result);
	echo'rows: '.$rows.' ';
	while($rows--){
		$row = mysqli_fetch_assoc($result);
		//echo $row['data']."<br><br><br>";
		echo $row['query'];
	}
	if(isset($_POST['name'])){
		$name = $_POST['name'];
		$time = $_POST['time'];
		echo"Name:".$name."    Time:".$time;
		echo"<br>".strtotime("+1 week");
	}
?>