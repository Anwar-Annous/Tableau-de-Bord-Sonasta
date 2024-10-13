<?php
session_start();
include 'conn.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if an id is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Get the id and convert it to an integer for security

    // Prepare the SQL DELETE query
    $sql = "DELETE FROM inventory WHERE id = ?";

    // Use a prepared statement to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id); // Bind the id parameter to the SQL query
        if ($stmt->execute()) {
            // If the delete operation was successful, redirect to the page displaying the table
            header('Location: ../matieres.php');
        } else {
            echo "Error: Could not execute delete operation.";
        }
        $stmt->close(); // Close the statement
    } else {
        echo "Error: Could not prepare delete query.";
    }
} else {
    echo "Invalid ID.";
}

$conn->close(); // Close the database connection
?>
