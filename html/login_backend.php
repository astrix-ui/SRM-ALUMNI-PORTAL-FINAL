<?php
session_start();
include("dbconfig.php");

if(isset($_POST['login'])){
$login_email=$_POST["login_email"];
$login_password=$_POST["login_password"];
// echo $login_email, $login_password;

$confirm="SELECT * FROM user WHERE email = '$login_email'";
$result=mysqli_query($conn,$confirm);
$num=mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);
// echo $row['password'];
if($num==1){
    // if($login_password== $row['password']){
    if(password_verify($login_password, $row['password'])){
        $_SESSION['user']=$login_email;
        header("location:index.php");
    }
    else{
        $_SESSION['fail']="Wrong password";
        header("location:login.php");
    }
}
else{
    $_SESSION['fail']="No account found with this email";
    header("location:login.php");
}}
else{
    header("location:login.php");
}
?>