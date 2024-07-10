<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
/*********************************************************************/
$conn=new mysqli("localhost","root","","ecom");
$mail_email="psychoblackheart17@gmail.com"; // email address
$mail_pass="Rajkumar@123"; // password
$mail_host=""; //for google smpt.google.com
$mail_sender="Rk"; // Company Name
/*******************************************************************/
$_state_ = array("Andaman and Nicobar", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli", "Daman & Diu", "Delhi", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Orissa", "Pondicherry", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Tripura", "Uttar Pradesh", "Uttaranchal", "West Bengal");




?>