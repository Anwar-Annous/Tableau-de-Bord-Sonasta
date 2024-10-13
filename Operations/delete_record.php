<?php
include 'conn.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM  gestion_emp WHERE ID = $id"; 

    if (mysqli_query($conn, $sql)) {
        header("Location: ../Gestion_Emp.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "ID not specified.";
}

// Close connection
mysqli_close($conn);
?>
