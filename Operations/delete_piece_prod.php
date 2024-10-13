<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Cast the ID to an integer for security

    // Prepare the SQL delete query
    $sql = "DELETE FROM prod_piece WHERE ID = $id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header('Location: ../piece prod.php?message=deleted');
        exit; 
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No ID specified.";
}

// Close the connection
$conn->close();
?>