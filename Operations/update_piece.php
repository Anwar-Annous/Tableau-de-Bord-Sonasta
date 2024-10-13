<?php
include 'conn.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Assuming the connection to the database is already established ($conn)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pieceId = $_POST['piece_id'];
    $pieceName = $_POST['piece_name'];
    $pieceDiameter = $_POST['piece_diameter'];
    $productionDate = $_POST['production_date'];
    $saleDate = $_POST['sale_date'];
    $salePrice = $_POST['sale_price'];
    $piecePhoto = $_FILES['piece_photo']['name'];

    // Check if a new photo was uploaded
    if ($piecePhoto) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES['piece_photo']['name']);
        move_uploaded_file($_FILES['piece_photo']['tmp_name'], $target_file);
        
        $query = "UPDATE prod_piece SET 
                    Nom_piece='$pieceName', 
                    Diameter_Piece='$pieceDiameter',
                    prod_date='$productionDate', 
                    sale_date='$saleDate', 
                    sale_prix='$salePrice', 
                    Photo_Piece='$piecePhoto' 
                  WHERE id='$pieceId'";
    } else {
        $query = "UPDATE prod_piece SET 
                    Nom_piece='$pieceName', 
                    Diameter_Piece='$pieceDiameter',
                    prod_date='$productionDate', 
                    sale_date='$saleDate', 
                    sale_prix='$salePrice'
                  WHERE id='$pieceId'";
    }

    // Execute the query and check for errors
    if (mysqli_query($conn, $query)) {
        // Redirect or show success message
        header("Location: ../piece prod.php");
        exit;
    } else {
        // Display error message if the query fails
        echo "Error updating record: " . mysqli_error($conn);
    }
}
