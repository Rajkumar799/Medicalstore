<?php
session_start();
include "../config.php";
include('smtp/PHPMailerAutoload.php');
if($_POST['action']=="send_otp" && $_POST['email']!=""){
	$otp = mt_rand(100000, 999999);
	$_SESSION['login_otp']=$otp;
	$email=$_POST['email'];
	$_SESSION['login_email']=$email;
    function smtp_mailer($to,$subject, $msg,$email,$pass,$host,$sender){
	$mail = new PHPMailer(); 
            $mail->IsSMTP(); 
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Host = $host;
            $mail->Port = 587; 
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            //$mail->SMTPDebug = 2; 
            $mail->Username = $email;
            $mail->Password = $pass;
            $mail->setFrom($email, $sender);
            $mail->Subject = $subject;
	$mail->Body =
"<!DOCTYPE html>
<html>
<head>
   <link rel='preconnect' href='https://fonts.googleapis.com'>
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap' rel='stylesheet'>
   <style>
 
body{
   background: #dee3ff;font-family: poppins;
}button{
   font-family: poppins;
}
*{
   margin:0;
   padding: 0;
   box-sizing: border-box;font-family: Calibri;
  
}.onkar_div{
   width:100%;
   padding: 0px;
   border-radius: 3px;
   background: white;
   margin:auto;
   margin-top:0;
   box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}p{font-size: 16px;
   color: #383838;font-weight: normal;
}button{
padding: 10px 20px;
border-radius: 3px;
color: white;font-family: Calibri!important;
background: #ffc107;
border:none;
outline: none;
cursor: pointer;font-weight: bold;
}.q{
   margin-top:10px;
}.logo{margin:10px;
   width:35px;height: 35px;

}.bg{
   width: 100%;
}
</style>
</head>
<body>
<div class='onkar_div'>
   <center><img src='https://yt3.ggpht.com/FvWPeM0jkTadubr2Y0eI6wywNVCRJ1H5jZhYEbmXG5YDUXSGYuTbAI-O7eGDO31ZSnkNUEs4SA=w1138-fcrop64=1,00005a57ffffa5a8-k-c0xffffffff-no-nd-rj' class='bg'></center>
   <br><h1 style='text-align: center;'>Welcome!</h1><br>
   <p>We're excited to have you,  get started. First, you need to confirm your account. Just copy and paste the OTP.</p><BR>
     <center><button style='font-weight:bold;font-size:25px;border-radius:5px;color:#fff;background:#0989ff;padding:10px 20px;'>".$msg."</button></center><br>
   <p>Ignore if OTP not requested by you.</p><br>
   <p>Cheers,<br>Team - Food Express</p>
</div>
<div class='onkar_div q'>
   <center>
   <div class='logos'>
      <img src='https://pentagonspace.in/mail/f.png' class='logo'>
      <img src='https://pentagonspace.in/mail/i.png' class='logo'>
      <img src='https://pentagonspace.in/mail/y.png' class='logo'>
      <img src='https://pentagonspace.in/mail/l.png' class='logo'>
   </div>
   <p style='text-align: center;'>All rights reseved ! <a href='#'>Food Express</a></p>
</center>
</div>
<br><br>
</body>
</html>";
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		return "0";
	}else{
		return "1";
	}
}
echo smtp_mailer($email,'Food Express - OTP',$otp,$mail_email,$mail_pass,$mail_host,$mail_sender);
}
elseif ($_POST['action']=="login" && $_POST['email']!="" && $_POST['otp']!="") {
	$email=$_POST['email'];
	$otp=$_POST['otp'];
	if($email==$_SESSION['login_email'] && $otp==$_SESSION['login_otp']){
		/**/
$sql = "SELECT * from cust where email='$email' and ban!='1'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$_SESSION['me']=$row['id'];
$_SESSION['ma']=$row['email'];setcookie("user_name", $row['name'], time() + (86400 * 30), "/");
setcookie("user_email", $row['email'], time() + (86400 * 30), "/");

  setcookie("me", $row['id'], time() + (86400 * 30), "/");
echo 200;
}
} else {
/* code where no email in db*/
$sql = "INSERT INTO cust (name, email)
VALUES ('New User', '$email')";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
  $_SESSION['me']=$last_id;
  $_SESSION['ma']=$email;
  setcookie("me", $last_id, time() + (86400 * 30), "/");
  echo 200;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
/***/
}

		/**/
	}else{
		echo "Wrong OTP!";
	}
}
elseif ($_POST['action']=="signup" && $_POST['e']!="" && $_POST['m']!="") {
   $e=$_POST['e'];
   $m=$_POST['m'];
   $p=$_POST['p'];
$sql = "INSERT INTO cust (name, email,phone,password) VALUES ('New User', '$e','$m','$p')";
if ($conn->query($sql) === TRUE) {echo 1;}else{echo 0;}
}elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == "log") {
    include "config.php"; // Ensure your database connection settings are included here

    // Sanitize user inputs
    $m = mysqli_real_escape_string($conn, $_POST['m']);
    $p = mysqli_real_escape_string($conn, $_POST['p']);

    // Query to retrieve user based on phone number and password
    $sql = "SELECT * FROM cust WHERE phone='$m' AND ban!='1' AND password='$p'";
    
    // Execute the query
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Fetch the user data
            while ($row = $result->fetch_assoc()) {
                $_SESSION['me'] = $row['id'];
                $_SESSION['ma'] = $row['email'];
                
                // Set cookies (optional)
                setcookie("user_name", $row['name'], time() + (86400 * 30), "/");
                setcookie("user_email", $row['email'], time() + (86400 * 30), "/");
                setcookie("me", $row['id'], time() + (86400 * 30), "/");

                echo 1; // Login successful
            }
        } else {
            echo "Invalid phone number or password."; // No matching user found
        }
    } else {
        // Handle database query error
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

?>