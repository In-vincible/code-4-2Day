<?php
$email = 'bikram.bharti99@gmail.com';
$subject ="ff";
$txt = " HI there !!!!";
$headers = "From: bikram.bharti.ece15@itbhu.ac.in";
                 
if(mail($email,$subject,$txt,$headers)) echo "mail sent successfully";
else echo "mail couldn't be sent";
?>