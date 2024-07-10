<?php
// Database connection code (in config.php or included file)
include "../config.php";

// Function to generate unique filename for uploaded images
function generateUniqueFileName($prefix, $extension) {
    $timestamp = time();
    $random = mt_rand(10000, 99999);
    return $prefix . '_' . $timestamp . '_' . $random . '.' . $extension;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $text3 = mysqli_real_escape_string($conn, $_POST['text3']);
    $text4 = mysqli_real_escape_string($conn, $_POST['text4']);
    $text5 = mysqli_real_escape_string($conn, $_POST['text5']);

    // File upload handling for image1
    $image1Name = $_FILES['image1']['name'];
    $image1TmpName = $_FILES['image1']['tmp_name'];
    $image1Error = $_FILES['image1']['error'];

    // File upload handling for image2
    $image2Name = $_FILES['image2']['name'];
    $image2TmpName = $_FILES['image2']['tmp_name'];
    $image2Error = $_FILES['image2']['error'];

    // Check if there are no file upload errors
    if ($image1Error === UPLOAD_ERR_OK && $image2Error === UPLOAD_ERR_OK) {
        // Generate unique filenames
        $image1Extension = pathinfo($image1Name, PATHINFO_EXTENSION);
        $image2Extension = pathinfo($image2Name, PATHINFO_EXTENSION);
        
        $image1UniqueName = generateUniqueFileName('image1', $image1Extension);
        $image2UniqueName = generateUniqueFileName('image2', $image2Extension);

        // Upload images to server
        $uploadPath = "../banner/"; // Directory where images will be uploaded
        move_uploaded_file($image1TmpName, $uploadPath . $image1UniqueName);
        move_uploaded_file($image2TmpName, $uploadPath . $image2UniqueName);

        // Insert data into database
        $sql = "INSERT INTO banner (t1, t2, link, big, small)
                VALUES ('$text3', '$text4', '$text5', '$image1UniqueName', '$image2UniqueName')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Records inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "File upload error.";
    }

    // Close database connection
    $conn->close();
}
?>
