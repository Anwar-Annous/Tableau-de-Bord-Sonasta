<?php
// Include your database connection
include 'conn.php';

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Cast the ID to an integer for security

    // Prepare the SQL delete query
    $sql = "DELETE FROM machines WHERE ID = $id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header('Location: ../machines.php?message=deleted');
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
