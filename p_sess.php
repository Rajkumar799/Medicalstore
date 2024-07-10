<?php
if(isset($_POST['action']) && $_POST['action']=="p_sess"){
	session_start();
	$_SESSION['p_sess']=$_POST['id'];
	echo $_SESSION['p_sess'];
}
?>