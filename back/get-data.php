<?php
include "../config.php";
//$sql = "SELECT * from item where id>".$_SESSION['fetch_id']." and disable='0'  and (price<=".$_SESSION['max']." and price>=".$_SESSION['min'].")".$_SESSION['_cat']. $_SESSION['_subcat'].$_SESSION['se_']." limit 10";
$sql = "SELECT * from item where id>".$_SESSION['fetch_id']." and disable='0'  and (price<=".$_SESSION['max']." and price>=".$_SESSION['min'].")".$_SESSION['_cat']. $_SESSION['_subcat'].$_SESSION['se_'].$_SESSION['state']." limit 10";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
   $data[]=$row;
    $_SESSION['fetch_id']=$row['id'];
   }
}

$jsonData = json_encode($data);
echo $jsonData;
?>