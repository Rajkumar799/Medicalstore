<?php
include '../config.php';
if(isset($_POST['action'])=="save_data"){
	$me=$_SESSION['me'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $company = $_POST['company'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];
  $pincode = $_POST['pincode'];
  $landmark = $_POST['landmark'];
  $sql = "UPDATE cust SET 
  name='$fname',
            lname = '$lname',
            company = '$company',
            phone = '$phone',
            state = '$state',
            city = '$city',
            address1 = '$address1',
            address2 = '$address2',
            pincode = '$pincode',
            landmark = '$landmark'
        WHERE 
            id='$me'";
            if ($conn->query($sql) === TRUE) {
    echo "Profile Updated!";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
}
?>