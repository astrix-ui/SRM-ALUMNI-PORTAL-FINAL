<?php

session_start();
include("dbconfig.php");

$user_email= $_SESSION['user'];

if(isset($_POST['edit_button'])){
$name = $_POST['name'];
$email = $_POST['email'];
$city= $_POST['city'];
$country=$_POST['country'];
$address=$_POST['address'];
$organization=$_POST['organization'];
$designation=$_POST['designation'];
$occupation=$_POST['occupation'];
$batch = $_POST['batch'];
$degree = $_POST['degree'];
$spl = $_POST['specialization'];
$is_student = $_POST['student'];

// echo $name, $email,$batch,$degree,$spl,$is_student,$city,$country,$address,$occupation,$organization,$designation;
$updateprofile="UPDATE user SET name='$name', email='$email' , city='$city' , country='$country', address='$address', organization='$organization', designation='$designation', occupation='$occupation', batch='$batch', degree='$degree', specialization='$spl', is_student='$is_student' WHERE email='$user_email'";
mysqli_query($conn,$updateprofile);
$_SESSION['user']=$email;
// echo $_SESSION['user'];
header("location:profile.php");
}; 

if(isset($_POST['submitAbout'])){
    $user_email= $_SESSION['user'];
 $about = mysqli_real_escape_string($conn, $_POST['about']);
$updateprofile="UPDATE user SET about='$about' WHERE email='$user_email'";
mysqli_query($conn,$updateprofile);
header("location:profile.php");
};

if(isset($_POST['change_pwd_button'])){
  
 $oldpass=$_POST['current_password'];
 $newpass=$_POST['new_password'];
 $cpass=$_POST['confirm_password'];

//  echo $oldpass, $newpass,$cpass;
//  die;

$confirm="SELECT * FROM user WHERE email = '$user_email'";
$result=mysqli_query($conn,$confirm);
$num=mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);

if(password_verify($oldpass, $row['password'])){
        
        if($newpass==$cpass){
             $hash = password_hash($newpass, PASSWORD_DEFAULT);
           $update_password="UPDATE user SET password='$hash' WHERE email='$user_email'";
           mysqli_query($conn,$update_password);
           header("location:profile.php");
        }
        else{
             $_SESSION['fail'] ="Passwords dont match";
             header("location:editprofile.php");
        }
    }
    else{
        $_SESSION['fail']="Wrong password";
        header("location:editprofile.php");
 
}
}


?>