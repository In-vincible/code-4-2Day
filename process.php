<?php
if(isset($_POST['data'])){ 
   $data = $_POST['data'];
   //echo"level 2 crossed";
   echo stripslashes($data);
}
else echo "bikram is the supreme truth!!!";

/*
if(isset($_GET['url'])){
	$url = $_GET['url'];
	header("location:$url");
}*/
?>