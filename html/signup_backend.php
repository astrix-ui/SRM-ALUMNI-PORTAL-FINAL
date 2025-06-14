<?php
session_start();
include("dbconfig.php");
if(isset($_POST['register'])){
$name = $_POST['name'];
$email = strtolower(trim($_POST['email']));
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$batch = $_POST['Batch'];
$degree = $_POST['degree'];
$spl = $_POST['specialization'];
$is_student = $_POST['student'];


// echo $username, $email, $password, $cpassword,$batch,$branch,$spl,$student;

$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num > 0) {
    $_SESSION['fail'] = "This email is already associated with an account";
    header("location:signup.php");
    exit();
    } elseif ($password == $cpassword) {
     $hash = password_hash($password, PASSWORD_DEFAULT);
    $create = "INSERT INTO `user` (user_id, name, email, password, batch, degree, specialization, is_student, timestamp)  VALUES (NULL, '$name', '$email', '$hash', '$batch', '$degree', '$spl', '$is_student', CURRENT_TIMESTAMP);";
    mysqli_query($conn, $create);

    $_SESSION['user'] = $email;
    header("location:profile.php");
    // ECHO"done";
      exit();
} else {
    $_SESSION['fail'] = "Passwords do not match";
    header("location:signup.php");
    exit();
}}
else{
    header("location:signup.php");
}
?>
