<?php
include 'Operations/conn.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['worker-id'];
    $name = $_POST['worker-name'];
    $email = $_POST['worker-email'];
    $phone = $_POST['worker-phone'];
    $role = $_POST['worker-role'];
    $hire_date = $_POST['hire-date'];
    $user = $_POST['worker-user'];
    $pass = $_POST['worker-pass'];

    if (isset($_FILES['worker-photo']) && $_FILES['worker-photo']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['worker-photo']['tmp_name'];
        $fileName = $_FILES['worker-photo']['name'];
        $fileSize = $_FILES['worker-photo']['size'];
        $fileType = $_FILES['worker-photo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExts = array('jpg', 'jpeg', 'png');
        if (in_array($fileExtension, $allowedExts)) {
            $uploadDir = 'img/';
            $destPath = $uploadDir . $fileName;

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // File upload successful
                $photo = $destPath;
            } else {
                die("Error moving the uploaded file");
            }
        } else {
            die("Unsupported file type");
        }
    } else {
        $photo = null;
    }
    

    $sql = "INSERT INTO gestion_emp ( Photo, Nom, Email, Tele, Role, Date_emb, user, pass) 
            VALUES ( '$photo', '$name', '$email', '$phone', '$role', '$hire_date', '$user', '$pass')";

    if (mysqli_query($conn, $sql)) {
        header('Location: Gestion_Emp.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
