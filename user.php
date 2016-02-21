<?php
define("MAX_LENGTH", 6);

if(isset($_POST['user']) && isset($_POST['pass'])){
$user = $_POST['user'];
$password = $_POST['pass'];
$email = $_POST['email'];
$gender = $_POST['gender'];
if($gender) $gender = 'male';
else $gender = 'female';
$password = hash("sha256", $password);
$password = salt($password);

}
else header("location:registration.php");
function salt($password) {
    $intermediateSalt = md5(uniqid(rand(), true));
    $salt = substr($intermediateSalt, 0, MAX_LENGTH);
    return hash("sha256", $password . $salt);
}




?>