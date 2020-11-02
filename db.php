<?php 

//connect to database
session_start();
$conn = mysqli_connect('localhost', 'root', '' , 'ninja_pizza');

//check connection 
if(!$conn) {
   echo 'Database Connection Error' . mysqli_connect_error();
 }


?>