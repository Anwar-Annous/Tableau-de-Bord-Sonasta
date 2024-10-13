<?php
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Step 3: Handle the file upload
    $target_dir = "../img"; // Directory to store the uploaded images
    $target_file = $target_dir . basename($_FILES["piece_photo"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a real image or fake
    $check = getimagesize($_FILES["piece_photo"]["tmp_name"]);
    if ($check !== false) {
        // File is an image
        if (move_uploaded_file($_FILES["piece_photo"]["tmp_name"], $target_file)) {
            $photo_path = basename($_FILES["piece_photo"]["name"]); // Save only the file name
        } else {
            die("Sorry, there was an error uploading your file.");
        }
    } else {
        die("File is not an image.");
    }

    // Step 4: Capture the rest of the form data
    $piece_name = $conn->real_escape_string($_POST['piece_name']);
    $piece_diameter = $conn->real_escape_string($_POST['piece_diameter']);
    $production_date = $conn->real_escape_string($_POST['production_date']);
    $sale_date = $conn->real_escape_string($_POST['sale_date']);
    $sale_price = $conn->real_escape_string($_POST['sale_price']);

    // Step 5: Insert the data into the database
    $sql = "INSERT INTO prod_piece (Photo_Piece, Nom_piece, Diameter_Piece, prod_date, sale_date, sale_prix)
            VALUES ('$photo_path', '$piece_name', '$piece_diameter', '$production_date', '$sale_date', '$sale_price')";

    if ($conn->query($sql) === TRUE) {
        echo "New piece added successfully!";
        header("Location: ../piece prod.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



?>