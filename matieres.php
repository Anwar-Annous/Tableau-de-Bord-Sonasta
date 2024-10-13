<?php
session_start();
include 'Operations/conn.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
$role = $_SESSION['user_role'];
$photo = $_SESSION['photo'];
$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);
$sql1 = "SELECT * FROM maintenance_materials";
$result1 = $conn->query($sql1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machines - Sonasta</title>
    <link rel="icon" type="image/png" href="img/Logo-mini.png">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="matieres.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body data-bs-theme="light">
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.php"><img src="img/LogoP.png" alt="Logo"></a>
                        </div>
                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2" >
                                        <img src="<?php echo $photo; ?>" alt="Avatar" class="img-fluid rounded-circle">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name"> <?php echo  $name; ?></h6>
                                        <p class="user-dropdown-status text-sm text-muted"><?php echo  $role; ?></p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="account-profile.html">My Account</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="login.php">Logout</a></li>
                                </ul>
                            </div>
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <nav class="navbar navbar-expand-lg navbar main-navbar">
                    <div class="container">
                        <ul class="navbar-nav mx-auto">
                            <li class="menu-item mx-4" >
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-item mx-4" >
                                <a href="piece%20Prod.html" class='menu-link'>
                                    <span><i class="bi bi"></i> Production des pièces mécaniques</span>
                                </a>
                            </li>
                            <li class="menu-item mx-4" >
                                <a href="#" >Les matières en Stock
                                </a>
                            </li>
                            <li class="menu-item mx-4">
                                <a class='menu-link' href="Machines.html"> Informations sur Les Machines de travail
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>                    
            </header>
                  
<!-- Add Modal Start -->
<div class="modal fade" id="Insert-Modal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(#4158A6,#3283c1);">
                <h5 class="modal-title white" id="addModalLabel">Ajouter une matière de maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="Gestion_emp/insert_mat_man.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mat-name" class="form-label">Matière:</label>
                        <input id="mat-name" name="mat_name" type="text" placeholder="Enter Material Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="form-label">Quantité:</label>
                        <input id="quantity" name="quantity" type="number" placeholder="Enter Quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="diameter" class="form-label">Diamètre:</label>
                        <input id="diameter" name="diameter" type="text" placeholder="Enter Diameter" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="storage" class="form-label">Dépôt de stockage:</label>
                        <input id="storage" name="storage" type="text" placeholder="Enter Storage Depot" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">État actuel:</label>
                        <div class="switch-cont">
                            <span class="opt-disp-edit" id="status-label">En stock</span>
                            <label class="switch">
                                <input type="checkbox" name="etat_actuel" id="insert-etat-actuel" onchange="toggleStatus()">
                                <div class="slider"></div>
                                <div class="slider-card">
                                    <div class="slider-card-face slider-card-front"></div>
                                    <div class="slider-card-face slider-card-back"></div>
                                </div>
                            </label>
                            <span class="opt-edit">Rupture de stock</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>


                        <!-- Modification Modal Start -->
<div class="modal fade text-left" id="Edit-Modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(#4158A6,#3283c1);">
                <h5 class="modal-title white" id="editModalLabel">Modifier une matière</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="Gestion_emp/update_mat_prod.php" method="POST" class="form-modern">
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id"> <!-- Hidden field for the record ID -->
                    <div class="form-group">
                        <label for="edit-matiere" class="form-label">Nom de la matière:</label>
                        <input id="edit-matiere" name="matiere" type="text" placeholder="Enter Material Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-quantite" class="form-label">Quantité:</label>
                        <input id="edit-quantite" name="quantite" type="number" placeholder="Enter Quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-diametre" class="form-label">Diamètre:</label>
                        <input id="edit-diametre" name="diametre" type="text" placeholder="Enter Diameter" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-depot-stockage" class="form-label">Dépôt de stockage:</label>
                        <input id="edit-depot-stockage" name="depot_stockage" type="text" placeholder="Enter Storage Depot" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">État actuel:</label>
                        <div class="switch-cont">
                            <span class="opt-disp-edit">En stock</span>
                            <label class="switch">
                                <input type="checkbox" id="edit-etat-actuel" name="etat_actuel">
                                <div class="slider"></div>
                                <div class="slider-card">
                                    <div class="slider-card-face slider-card-front"></div>
                                    <div class="slider-card-face slider-card-back"></div>
                                </div>
                            </label>
                            <span class="opt-edit">Rupture de stock</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Fermer</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Modifier</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


                               <!-- Delete Confirmation Modal -->
<div class="modal fade" id="Delete-Modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de Suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet enregistrement ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" id="confirm-delete-btn" class="btn btn-danger">Supprimer</button>
            </div>
        </div>
    </div>
</div>
                                <div class="form-box">
                                    <div class="button-box">
                                        <div id="btn"></div>
                                        <button type="button" class="toggle-btn" onclick="leftClick()">Production</button>
                                        <button type="button" class="toggle-btn" onclick="rightClick()">Maintenance</button>
                                    </div>
                                </div>
                                <script src="matieres.js"></script>

                                <!-- Contant Table Start -->
            <div class="content-wrapper container">
                <div class="page-heading">
                </div>
                <div class="page-content">
                    <main class="table" id="production">
                        <section class="table__header">
                        <h3 style="display: flex;justify-content: center;align-items: center;width: 100%;">Matière de production</h3>
                        <div class="cont">
                            <div class="Add">
                                <img src="img/add.svg" class="Add-btn" data-bs-toggle="modal" data-bs-target="#Insert-Modal" alt="Modification Icon">
                            </div>
                            <div class="export__file">
                                <label for="export-file" class="export__file-btn" title="Export File"></label>
                                <input type="checkbox" id="export-file">
                                <div class="export__file-options">
                                    <label for="export-file" id="toPDF">PDF <img src="images/pdf.png" alt=""></label>
                                    <label for="export-file" id="toEXCEL">EXCEL <img src="images/excel.png" alt=""></label>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="table__body">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Matière</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-center">Diamètre</th>
                                    <th class="text-center">Dépôt de stockage</th>
                                    <th class="text-center">État actuel</th>
                                    <th class="text-center">Opérations</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='text-center'>" . $row['id'] . "</td>";
                    echo "<td class='text-center'>" . $row['matiere'] . "</td>";
                    echo "<td class='text-center'>" . $row['quantite'] . "</td>";
                    echo "<td class='text-center'>" . $row['diametre'] . "</td>";
                    echo "<td class='text-center'>" . $row['depot_stockage'] . "</td>";
                    echo "<td class='text-center'><p class='status " . ($row['etat_actuel'] == 'En stock' ? 'delivered' : 'cancelled') . "'>" . $row['etat_actuel'] . "</p></td>";
                    echo "<td class='text-center'>";
                    echo "<img src='img/trash-2.svg' style='cursor:pointer;padding-left:10px;' alt='Delete Icon' data-bs-toggle='modal' data-bs-target='#Delete-Modal' onclick='setDeleteId(" . $row['id'] . ", \"inventory\")'>";
                    echo "<img src='img/edit.svg' style='cursor:pointer; padding-left:11px;' 
                    data-bs-toggle='modal' data-bs-target='#Edit-Modal' 
                    alt='Modification Icon' 
                    onclick='populateEditModal(" . $row['id'] . ", \"" . addslashes($row['matiere']) . "\", " . $row['quantite'] . ", \"" . addslashes($row['diametre']) . "\", \"" . addslashes($row['depot_stockage']) . "\", \"" . addslashes($row['etat_actuel']) . "\")'>";
                                
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // If there are no records
                echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
            }
            ?>
                            </tbody>
                        
                        </table>
                    </section>
                </main>
                <main class="table" id="maintenance" style="display: none;">
                    <section class="table__header">
                    <h3 style="display: flex;justify-content: center;align-items: center;width: 100%;">Matière de Maintenance</h3>
                    <div class="cont">
                        <div class="Add">
                            <img src="img/add.svg" class="Add-btn" data-bs-toggle="modal" data-bs-target="#Add-Modal" alt="Modification Icon">
                        </div>
                        <div class="export__file">
                            <label for="export-file" class="export__file-btn" title="Export File"></label>
                            <input type="checkbox" id="export-file">
                            <div class="export__file-options">
                                <label for="export-file" id="toPDF">PDF <img src="images/pdf.png" alt=""></label>
                                <label for="export-file" id="toEXCEL">EXCEL <img src="images/excel.png" alt=""></label>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="table__body">
                    <table>
                    <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Matière</th>
                                <th class="text-center">Quantité</th>
                                <th class="text-center">Diamètre</th>
                                <th class="text-center">Dépôt de stockage</th>
                                <th class="text-center">État actuel</th>
                                <th class="text-center">Opérations</th>
                            </tr>
                        </thead>
                        <tbody>-
                    <?php
        // Check if the query returned any results
        if ($result1->num_rows > 0) {
            // Loop through each record and output the table rows
            while ($row = $result1->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='text-center'>" . $row['id'] . "</td>";
                echo "<td class='text-center'>" . $row['matiere'] . "</td>";
                echo "<td class='text-center'>" . $row['quantite'] . "</td>";
                echo "<td class='text-center'>" . $row['diametre'] . "</td>";
                echo "<td class='text-center'>" . $row['depot_stockage'] . "</td>";
                echo "<td class='text-center'><p class='status " . ($row['etat_actuel'] == 'En stock' ? 'delivered' : 'cancelled') . "'>" . $row['etat_actuel'] . "</p></td>";
                echo "<td>";
                echo "<img src='img/trash-2.svg' style='cursor:pointer;padding-left:10px;' alt='Delete Icon' data-bs-toggle='modal' data-bs-target='#Delete-Modal' onclick='setDeleteId(" . $row['id'] . ", \"maintenance_materials\")'>";
                echo "<img src='img/edit.svg' style='cursor:pointer; padding-left:11px;' data-bs-toggle='modal' data-bs-target='#Mod-Modal' alt='Modification Icon' onclick='editItem(" . $row['id'] . ")'>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>Aucun enregistrement trouvé</td></tr>";
        }
        ?>
                        </tbody>
                    
                    </table>
                </section>
            </main>
            </div>
                                            <!-- Contant Table End -->

                    <hr>
            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2024 &copy; Anweer</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
</div>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/static/js/pages/horizontal-layout.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
    <script src="matieres.js"></script>
    <script>
// JavaScript function to set the ID and type for deletion in the modal
let deleteId = null;
let deleteType = null;

function setDeleteId(id, type) {
    deleteId = id;
    deleteType = type;

    document.getElementById('confirm-delete-btn').onclick = function() {
        window.location.href = 'gestion_emp/delete_matiere.php?id=' + deleteId + '&type=' + deleteType;
    };
}

// JavaScript function to edit item (showing data in modal)
function editItem(id) {
    fetch('get_item.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('machine-name').value = data.matiere;
            document.getElementById('annual-stoppages').value = data.quantite;
            document.getElementById('weekly-hours').value = data.diametre;
            document.getElementById('spare-parts').value = data.depot_stockage;
            document.querySelector('.switch input').checked = (data.etat_actuel === 'Disponible');
        });
}

        function editItem(id) {
            // Set the form values to the item being edited
            document.getElementById('editId').value = id;

            // Assuming you have a function to get data for editing
            fetch(`get_item_data.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editMatiere').value = data.matiere;
                    document.getElementById('editQuantite').value = data.quantite;
                    document.getElementById('editDiametre').value = data.diametre;
                    document.getElementById('editDepotStockage').value = data.depot_stockage;
                    document.getElementById('editEtatActuel').value = data.etat_actuel;
                });
        }

        function saveChanges() {
            // Get the form values
            let id = document.getElementById('editId').value;
            let matiere = document.getElementById('editMatiere').value;
            let quantite = document.getElementById('editQuantite').value;
            let diametre = document.getElementById('editDiametre').value;
            let depot_stockage = document.getElementById('editDepotStockage').value;
            let etat_actuel = document.getElementById('editEtatActuel').value;

            // Send the updated data to the server
            fetch(`update_item.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, matiere, quantite, diametre, depot_stockage, etat_actuel })
            }).then(response => {
                if (response.ok) {
                    // Reload the page or update the table to reflect changes
                    location.reload();
                }
            });
        }
  // Function to populate the edit modal with existing data
  function populateEditModal(id, matiere, quantite, diametre, depot_stockage, etat_actuel) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-matiere').value = matiere;
        document.getElementById('edit-quantite').value = quantite;
        document.getElementById('edit-diametre').value = diametre;
        document.getElementById('edit-depot-stockage').value = depot_stockage;

        // Set the checkbox based on the current state
        document.getElementById('edit-etat-actuel').checked = (etat_actuel === 'Rupture de stock');

        // Show the modal
        $('#Edit-Modal').modal('show');
    }
    function toggleStatus() {
    const checkbox = document.getElementById('insert-etat-actuel');
    const statusLabel = document.getElementById('status-label');

    // Update the status label based on the checkbox state
    if (checkbox.checked) {
        statusLabel.textContent = 'En stock';  // Status if checked
        checkbox.value = 'en stock';            // Set value for submission
    } else {
        statusLabel.textContent = 'Rupture de stock'; // Status if unchecked
        checkbox.value = 'rupture de stock';    // Set value for submission
    }
}
</script>

</body>
</html>