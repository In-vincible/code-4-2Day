<?php
if(isset($_POST['data'])){ 
   $data = $_POST['data'];
   // we are double stripping as slashes are added while passing data with form.
   echo stripslashes(stripslashes($data));
}
else header("location:registration.php");

?>