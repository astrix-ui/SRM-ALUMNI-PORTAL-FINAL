<?php

include("dbconfig.php");
if(isset($_POST['unfollow'])){
$loggedin_user_id=$_POST['loggedin_user_id'];
$otheruser_id=$_POST['otheruser_id'];
$otheruser_name=$_POST['otheruser_name'];


$sql="DELETE FROM follow WHERE user_id='$loggedin_user_id' AND otheruser_id='$otheruser_id'";
$result11=mysqli_query($conn,$sql);


    echo'<form id="redirectForm" action="showprofile.php?name=' . $otheruser_name . '" method="POST">
        <input type="hidden" name="user_id" value="' . $otheruser_id . '">
    </form>
    <script>
        document.getElementById("redirectForm").submit();
    </script>';
    exit;
}
else{
    header("location:login.php");
}
?>