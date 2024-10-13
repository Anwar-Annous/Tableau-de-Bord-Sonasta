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
$sql = "SELECT ID, Nom_Machine, nbr_empg_annual, heur_sem, piece_dispo, etat_actual FROM machines";
$result = $conn->query($sql);
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
    <link rel="stylesheet" href="Machines.css">
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
                                <a href="index.php" class='menu-link'>
                                    <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-item mx-4" >
                                <a href="piece%20Prod.php" class='menu-link'>
                                    <span><i class="bi bi"></i> Production des pièces mécaniques</span>
                                </a>
                            </li>
                            <li class="menu-item mx-4" >
                                <a href="matieres.html" class='menu-link'>Les matières en Stock
                                </a>
                            </li>
                            <li class="menu-item mx-4">
                                <a class="nav-link" href="#"> Informations sur Les Machines de travail
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>                    
            </header>
                    <!-- Delete Confirmation Modal Start -->
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
<!-- Delete Confirmation Modal End -->
                                <!-- Add Modal Start -->
                                <div class="modal fade text-left" id="Add-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(#4158A6,#3283c1);">
                <h5 class="modal-title white" id="myModalLabel160">Ajouter une machine</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="Gestion_emp/add_machine.php" method="POST" class="form-modern">
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="form-group">
                        <label for="worker-photo-add" class="form-label">Photo :</label>
                        <input id="worker-photo-add" name="worker-photo" type="file" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="machine-name" class="form-label">Nom de machine:</label>
                        <input id="machine-name" name="machine_name" type="text" placeholder="Enter Machine Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="annual-stoppages" class="form-label">Nombre d'arrêts annuels:</label>
                        <input id="annual-stoppages" name="annual_stoppages" type="number" placeholder="Enter Annual Stoppages" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="weekly-hours" class="form-label">Heures de travail chaque semaine:</label>
                        <input id="weekly-hours" name="weekly_hours" type="number" placeholder="Enter Weekly Hours" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="spare-parts" class="form-label">Pièces de rechange disponibles:</label>
                        <input id="spare-parts" name="spare_parts" type="text" placeholder="Enter Spare Parts" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">État actuel:</label>
                        <div class="switch-cont">
                            <span class="opt-disp">Disponible</span>
                            <div class="toggle-switch">
                                <div class="bauble_box">
                                    <input class="bauble_input" id="bauble_check" name="machine_status" type="checkbox">
                                    <label class="bauble_label" for="bauble_check">Toggle</label>
                                </div>
                            </div>
                            <span class="opt">Hors service</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-1">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

                                <!-- Add Modal End -->
                                 <!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal2-content">
           
            <div class="modal-body">
                <img id="modal-image" src="" alt="Image Preview" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
               <!-- Edit Modal Start -->
<div class="modal fade text-left" id="Edit-Modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(#4158A6,#3283c1);">
                <h5 class="modal-title white" id="editModalLabel">Modifier une machine</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="Gestion_emp/update_machine.php" method="POST" class="form-modern">
                <div class="modal-body">
                    <input type="hidden" name="machine_id" id="edit-machine-id">
                    <div class="form-group">
                        <label for="edit-machine-name" class="form-label">Nom de machine:</label>
                        <input id="edit-machine-name" name="machine_name" type="text" placeholder="Enter Machine Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-annual-stoppages" class="form-label">Nombre d'arrêts annuels:</label>
                        <input id="edit-annual-stoppages" name="annual_stoppages" type="number" placeholder="Enter Annual Stoppages" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-weekly-hours" class="form-label">Heures de travail chaque semaine:</label>
                        <input id="edit-weekly-hours" name="weekly_hours" type="number" placeholder="Enter Weekly Hours" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-spare-parts" class="form-label">Pièces de rechange disponibles:</label>
                        <input id="edit-spare-parts" name="spare_parts" type="text" placeholder="Enter Spare Parts" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">État actuel:</label>
                        <div class="switch-cont">
                            <span class="opt-disp">Disponible</span>
                            <div class="toggle-switch">
                                <div class="bauble_box">
                                    <input class="bauble_input" id="edit-bauble_check" name="machine_status" type="checkbox">
                                    <label class="bauble_label" for="edit-bauble_check">Toggle</label>
                                </div>
                            </div>
                            <span class="opt">Hors service</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-1">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal End -->


                        <!-- Contant Table Start -->
            <div class="content-wrapper container">
                <div class="page-heading">
                </div>
                <div class="page-content">
                <main class="table" id="customers_table">
                <section class="table__header">
                    <h3 style="display: flex;justify-content: center;align-items: center;width: 100%;"> Informations sur Les Machines de travaille</h3>
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
                <table  >
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Nom de machine</th>
            <th class="text-center">Nomber d'empagne Annual</th>
            <th class="text-center">Heures/semain</th>
            <th class="text-center">Les pièces de rechange dispo</th>
            <th class="text-center">L'état Actual</th>
            <th class="text-center">Opération</th>
        </tr>
    </thead>
    <tbody>
    <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $encodedRow = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
        $statusClass = ($row["etat_actual"] == 'Hors-Service') ? 'cancelled' : ($row["etat_actual"] == 'En-Service' ? 'delivered' : '');

        echo "<tr>";
        echo "<td class='text-center'>" . $row["ID"] . "</td>";
        echo "<td class='text-center'>
        <img src='images/machine" . $row["ID"] . ".webp' onclick='updateModalImage(this.src)' data-toggle='modal' data-target='#imageModal' alt='Machine " . $row["ID"] . "' />
        " . $row["Nom_Machine"] . "
      </td>";        echo "<td class='text-center'>" . $row["nbr_empg_annual"] . "</td>";
        echo "<td class='text-center'>" . $row["heur_sem"] . " heures</td>";
        echo "<td class='text-center'>" . $row["piece_dispo"] . " pièces</td>";
        echo "<td class='text-center'><p class='status $statusClass'>" . $row["etat_actual"] . "</p></td>";
        echo "<td class='text-center'>
    <img src='img/trash-2.svg' style='cursor:pointer;padding-left:10px;' alt='Delete Icon' data-bs-toggle='modal' data-bs-target='#Delete-Modal' onclick='setDeleteId(" . $row["ID"] . ")'>
    <img src='img/edit.svg' style='cursor:pointer; padding-left:11px;' data-bs-toggle='modal' data-bs-target='#Edit-Modal'
        onclick='populateEditModal(" . $encodedRow . ")' alt='Modification Icon'>
</td>
";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>No data available</td></tr>";
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
    <script src="Machines.js"></script>
    <script>
    let deleteId = null;

// Set the delete ID when delete button is clicked
function setDeleteId(id) {
    deleteId = id; // Store the ID of the machine to delete
}

// When the confirm delete button is clicked
document.getElementById('confirm-delete-btn').addEventListener('click', function() {
    if (deleteId) {
        // Redirect to the delete PHP script with the machine ID
        window.location.href = 'gestion_emp/delete_machine.php?id=' + deleteId;
    }
});

function populateEditModal(data) {
    const machine = JSON.parse(data); // Parse the received JSON data

    // Set the input values in the modal
    document.getElementById('edit-machine-id').value = machine.ID;
    document.getElementById('edit-machine-name').value = machine.Nom_Machine;
    document.getElementById('edit-annual-stoppages').value = machine.nbr_empg_annual;
    document.getElementById('edit-weekly-hours').value = machine.heur_sem;
    document.getElementById('edit-spare-parts').value = machine.piece_dispo;

    // Set the status checkbox based on current status
    const statusCheckbox = document.getElementById('edit-bauble_check');
    statusCheckbox.checked = (machine.etat_actual === 'En-Service');
}

function updateModalImage(src) {
        document.getElementById('modal-image').src = src;
    }


</script>
</body>
</html>