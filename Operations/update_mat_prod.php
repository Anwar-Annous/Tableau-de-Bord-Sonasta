<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = (int) $_POST['id'];
    $matiere = mysqli_real_escape_string($conn, $_POST['matiere']);
    $quantite = (int) $_POST['quantite'];
    $diametre = mysqli_real_escape_string($conn, $_POST['diametre']);
    $depot_stockage = mysqli_real_escape_string($conn, $_POST['depot_stockage']);
    $etat_actuel = isset($_POST['etat_actuel']) ? "Rupture de stock" : "En stock";

    // Update data in the inventory table
    $sql = "UPDATE inventory 
            SET matiere = '$matiere', quantite = $quantite, diametre = '$diametre', depot_stockage = '$depot_stockage', etat_actuel = '$etat_actuel' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        // Optionally, redirect to another page after update
        header('Location: ../matieres.php?');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>