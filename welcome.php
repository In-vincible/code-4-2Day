<?php
session_start();
if(isset($_SESSION['id'])){
	$user_id = $_SESSION['id'];
	if($user_id){
	
        $user   =    $_SESSION['user']; 
    	$key = $_SESSION['key'];
    echo"<h3>Welcome to Football Data Api (user No.: ".$user_id. ")</h3>";
    echo"<h4>Hello ".$user."</h4>\n <font color='green'>Your Api Key(Also Sent to Your Mail):</font>".$key;
    echo "<p>Please Refer to the <a href='https://github.com/vincible/code-4-2Day'>git hub documentation of Api</a> for using the Api Effectivly</p>";	
	}
	else{
		echo"<font color='red'>Due some Unknown Error your Data couldn't be stored in database,<br> Please try again to register<a href='registration.php'>Click Here</a>to go to registration Page</font>";
	}
	session_destroy();
}

else header("location:registration.php");
?>