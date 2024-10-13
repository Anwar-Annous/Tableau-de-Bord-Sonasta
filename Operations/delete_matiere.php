<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if ID and type parameters are set
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = intval($_GET['id']);  // Ensure the ID is an integer
    $type = $_GET['type'];

    // Prepare and execute delete query based on the table type
    if ($type === 'inventory') {
        $sql = "DELETE FROM inventory WHERE id = ?";
    } elseif ($type === 'maintenance_materials') {
        $sql = "DELETE FROM maintenance_materials WHERE id = ?";
    } else {
        // Invalid type provided, handle error
        die("Invalid table type specified.");
    }

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);  // Bind the ID parameter
        if ($stmt->execute()) {
            // Deletion successful
            header('Location: ../matieres.php?');
            exit();
        } else {
            // Deletion failed
            header('Location: your_page.php?delete_error=1');  // Redirect back with error message
            exit();
        }
    } else {
        // Prepare statement failed
        die("Database error: Could not prepare statement.");
    }
} else {
    // ID or type not set
    die("Invalid request.");
}
