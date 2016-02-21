<?php
define("MAX_LENGTH", 6);
//connection credentials for database
$mysql_hostname = "mysql15.000webhost.com";
    $mysql_user = "a6204434_bikram";
    $mysql_password ="bikram";
    $mysql_database ="a6204434_laundry";
    
    $connection = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("Could not connect database");
	
session_start();
if(isset($_POST['user']) && isset($_POST['pass'])){
//escaping data recieved by the registration
 $user = mysqli_real_escape_string($connection,$_POST['user']);
 $email = mysqli_real_escape_string($connection,$_POST['email']);
 $password = mysqli_real_escape_string($connection,$_POST['pass']);
 $gender = $_POST['gender'];
 $password = salt($password);
 //Query for inserting user data to database.
 //$query = "INSERT INTO `auth`(`user`, `pass`, `email`, `gender`) VALUES ('".$user."','".$password."','".$email."','".$gender."')";
 
 $query = "SELECT * FROM auth WHERE user='".$user."'";
 
 
 
 
 $result = mysqli_query($connection,$query);
 $rows = mysqli_num_rows($result); 
 while($rows--){
	 $m = mysqli_fetch_assoc($result);
	 echo "Id = ".$m['id']."<br>pass=".$m['pass']."<br><br>";
 }
 echo mysqli_error($connection);
/*
 $user_id = mysqli_insert_id($connection); 
 //creating session for use in welcome page.(I will user encrypted pass as key of user.)
                $_SESSION['id'] = $user_id;
    			$_SESSION['user'] = $user;
    			
				session_write_close();
//sending mail(key and welcome message) to the registered user.
				$subject = "Your very own Football Api";
                $txt = "Hello".$user."!!! \nWelcome to the World of FootBall.\nyour api key: ".$password;
               // $headers = "From: bikram.bharti.ece15@itbhu.ac.in" . "\r\n" .
                  "CC: bikram.bharti99@gmail.com";

                mail($email,$subject,$txt);
				echo $user_id."    ".$password;
				
				//header("location:welcome.php");
				//exit();
*/
}
else header("location:registration.php");
//salt function for encryption of password
function salt($password) {
    $intermediateSalt = md5(uniqid(rand(), true));
    $salt = substr($intermediateSalt, 0, MAX_LENGTH);
    return hash("sha256", $password . $salt);
}



?>