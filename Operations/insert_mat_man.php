<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $mat_name = mysqli_real_escape_string($conn, $_POST['mat_name']);
    $quantity = (int) $_POST['quantity'];
    $diameter = mysqli_real_escape_string($conn, $_POST['diameter']);
    $storage = mysqli_real_escape_string($conn, $_POST['storage']);
    $etat_actuel = isset($_POST['etat_actuel']) ? "Rupture de stock" : "En stock";

    // Insert data into the inventory table
    $sql = "INSERT INTO inventory (matiere, quantite, diametre, depot_stockage, etat_actuel) 
            VALUES ('$mat_name', $quantity, '$diameter', '$storage', '$etat_actuel')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Optionally, redirect to another page after insertion
        header('Location: ../matieres.php?');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>



