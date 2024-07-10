<?php
require "../config.php";
$me=$_SESSION['me'];
if($_POST['action']=='letter'){
    $email=$_POST['email'];
    $sql="INSERT INTO `news`( `email`, `user`) VALUES ('$email','$me')";
    if ($conn->query($sql) === true) {
                echo 1;
            } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
            }
}
?>