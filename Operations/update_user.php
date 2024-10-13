<?php
include 'conn.php';
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Get the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // Update query
    $sql = "UPDATE gestion_emp SET Nom = ?, Email = ?, Tele = ?, Date_naiss = ?, Genre = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $email, $phone, $birthday, $gender, $user_id);

    if ($stmt->execute()) {
        echo "User data updated successfully!";
    } else {
        echo "Error updating user data: " . $conn->error;
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    header('Location: login.php');
    exit();
}
?>
