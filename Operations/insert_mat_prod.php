<?php
session_start();
include 'conn.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $material_name = $_POST['mat_name'];      // Get the name of the material
    $material_quantity = $_POST['quantity'];   // Get the quantity
    $material_diameter = $_POST['diameter'];   // Get the diameter
    $storage_depot = $_POST['storage'];        // Get the storage depot
    $current_status = $_POST['etat_actuel'] == 'on' ? 'en stock' : 'rupture de stock'; // Determine current status

    // Debugging output
    error_log("Material Name: $material_name");
    error_log("Quantity: $material_quantity");
    error_log("Diameter: $material_diameter");
    error_log("Storage Depot: $storage_depot");
    error_log("Current Status: $current_status");
    
    // Prepare the SQL insert statement
    $insertMaterialSQL = "INSERT INTO maintenance_materials (matiere, quantite, diametre, depot_stockage, etat_actuel) VALUES (?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($insertMaterialSQL)) {
        $stmt->bind_param("sisss", $material_name, $material_quantity, $material_diameter, $storage_depot, $current_status);
        
        if ($stmt->execute()) {
            header('Location: ../matieres.php?');
            exit();
        } else {
            header('Location: your_page.php?add_material_error=1'); // Redirect on error
            exit();
        }
    } else {
        die("Database error: Could not prepare statement.");
    }
}
// Close the database connection
$conn->close();
?>
