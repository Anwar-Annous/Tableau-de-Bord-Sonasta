<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Make sure the correct names are used for POST variables
    $id = $_POST['machine_id'];  // Ensure this matches the hidden field name
    $name = $_POST['machine_name'];  // Change 'Nom_Machine' to 'machine_name'
    $annual_stoppages = $_POST['annual_stoppages']; // Change 'nbr_empg_annual' to 'annual_stoppages'
    $weekly_hours = $_POST['weekly_hours']; // Change 'heur_sem' to 'weekly_hours'
    $spare_parts = $_POST['spare_parts']; // Change 'piece_dispo' to 'spare_parts'
    
    // Checkbox name should match what you have in the modal
    $etat_actual = isset($_POST['machine_status']) ? 'En-Service' : 'Hors-Service';

    // Prepare the update SQL query
    $sql = "UPDATE machines SET 
            Nom_Machine = ?, 
            nbr_empg_annual = ?, 
            heur_sem = ?, 
            piece_dispo = ?, 
            etat_actual = ? 
            WHERE ID = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    
    // Make sure the types match your database schema
    $stmt->bind_param("ssssis", $name, $annual_stoppages, $weekly_hours, $spare_parts, $etat_actual, $id);

 // Execute the update
if ($stmt->execute()) {
    // Redirect to the main page or show a success message
    header('Location: ../Machines.php?message=updated');
    exit();
} else {
    // Output detailed error message
    echo "Error executing statement: " . htmlspecialchars($stmt->error);
}

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
