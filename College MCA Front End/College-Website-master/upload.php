<?php
session_start();
include('db_connection.php'); // Make sure to adjust this if your DB connection file is located elsewhere

// Directory to store uploaded images
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is an actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size (limit: 20MB)
if ($_FILES["image"]["size"] > 20000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert image details into the database if necessary
        $image_name = htmlspecialchars(basename($_FILES["image"]["name"]));
        $image_path = $target_file;

        $sql = "INSERT INTO image_gallery (image_name, image_path) VALUES ('$image_name', '$image_path')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "The file " . htmlspecialchars($image_name) . " has been uploaded successfully.";
            header("Location: gallery.php"); // Redirect back to the gallery page
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Close the database connection
$conn->close();
?>
