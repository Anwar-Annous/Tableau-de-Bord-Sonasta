<?php
// Start session
session_start();

// Include database connection file
include 'conn.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']); // Fetch role from form
    $date_emb = mysqli_real_escape_string($conn, $_POST['date_emb']);

    // Prepare SQL update query
    $sql = "UPDATE gestion_emp SET Nom = ?, Email = ?, Tele = ?, Role = ?, Date_emb = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $email, $phone, $role, $date_emb, $user_id);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "User data updated successfully!";
        // Optionally redirect to a different page or refresh the form
        header('Location: ../account-profile.php');
        exit();
    } else {
        echo "Error updating user data: " . $conn->error;
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    // Redirect to login page if session is not set
    header('Location: login.php');
    exit();
}
?>
