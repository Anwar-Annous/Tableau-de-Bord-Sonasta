<?php
// Include the connection file
include 'conn.php';

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$id = isset($_POST['id']) ? intval($_POST['id']) : 0; // Use POST for form submission
$name = '';
$email = '';
$phone = '';
$role = '';
$date_emb = '';
$photo = '';

// Fetch record if ID is valid
if ($id > 0) {
    $sql = "SELECT ID, Photo, Nom, Email, Tele, Role, Date_emb FROM Gestion_Emp WHERE ID = $id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = htmlspecialchars($row['Nom']);
        $email = htmlspecialchars($row['Email']);
        $phone = htmlspecialchars($row['Tele']);
        $role = htmlspecialchars($row['Role']);
        $date_emb = htmlspecialchars($row['Date_emb']);
        $photo = htmlspecialchars($row['Photo']);
    } else {
        die("Record not found.");
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0; // Ensure ID is fetched from POST
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $date_emb = mysqli_real_escape_string($conn, $_POST['date_emb']);
    
    // Handle file upload if applicable
    $photo = $_FILES['photo']['name'];
    if ($photo) {
        $target = 'img/' . basename($photo);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $photo = $target;
        } else {
            echo "Error uploading photo.";
            $photo = ''; // Clear photo if upload fails
        }
    }

    // Update record
    if ($id > 0) {
        if (empty($photo)) {
            // If no new photo is uploaded, retain the old photo
            $sql = "UPDATE Gestion_Emp SET Nom='$name', Email='$email', Tele='$phone', Role='$role', Date_emb='$date_emb' WHERE ID=$id";
        } else {
            $sql = "UPDATE Gestion_Emp SET Nom='$name', Email='$email', Tele='$phone', Role='$role', Date_emb='$date_emb', Photo='$photo' WHERE ID=$id";
        }

        if (mysqli_query($conn, $sql)) {
            header('Location: ../gestion_emp.php'); // Redirect to the table page after update
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "ID is not specified.";
    }
}
?>
