<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "chatroom";

$conn = mysqli_connect($server_name,$user_name,$password,$db_name);

//check connection
if(!$conn){
    die("failed to connect" . mysqli_connect_error());
}
else{

}
?>