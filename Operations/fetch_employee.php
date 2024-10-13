<?php
include 'conn.php';

// Get the employee ID from the request
$employee_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($employee_id > 0) {
    $sql = "SELECT user, pass FROM gestion_emp WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $stmt->bind_result($username, $password);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    // Return the data as JSON
    echo json_encode(array('username' => $username, 'password' => $password));
} else {
    echo json_encode(array('error' => 'Invalid ID'));
}
?>
