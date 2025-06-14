<?php 

$servername="localhost";
$username="root";
$password="";
$database="alumni";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    echo"SERVER NOT CONNECTED";
}
// else{
//     echo"done";
// }
?>