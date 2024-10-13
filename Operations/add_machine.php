<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $machine_name = mysqli_real_escape_string($conn, $_POST['machine_name']);
    $annual_stoppages = (int) $_POST['annual_stoppages'];  // Convert to integer
    $weekly_hours = (int) $_POST['weekly_hours'];  // Convert to integer
    $spare_parts = mysqli_real_escape_string($conn, $_POST['spare_parts']);
    
    $machine_status = isset($_POST['machine_status']) ? 'Hors-Service' : 'En-Service';

    $sql = "INSERT INTO machines (Nom_Machine, nbr_empg_annual, heur_sem, piece_dispo, etat_actual) 
            VALUES ('$machine_name', $annual_stoppages, $weekly_hours, '$spare_parts', '$machine_status')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../Machines.php');
        exit; // Important to stop further execution after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the connection (if necessary)
    // $conn->close(); // Not needed if `conn.php` handles connection closing
}
?>
