<?php

include "../config.php";
$_cat_ = array();

$sql = "SELECT * FROM cat";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cat_id = $row['id'];
        $cat_logo = $row['logo'];
        $cat_name = $row['cat'];
        $subcategories = explode(',', $row['subcat']); // Split subcategories by comma

        $_cat_[$cat_id] = array($cat_id, $cat_logo, $cat_name, $subcategories);
    }
}













if($_POST['action']=='cat'){
$categoryID = isset($_POST['category_id']) ? $_POST['category_id'] : null;
$subcategories = array();
foreach ($_cat_ as $category) {
    if ($category[0] == $categoryID && isset($category[3])) {
        $subcategories = $category[3];
        break;
    }
}

// Return subcategories as JSON
echo json_encode($subcategories);
}
?>