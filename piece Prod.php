
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
$sql = "SELECT id, Photo_Piece, Nom_piece, Diameter_Piece, prod_date, sale_date, sale_prix FROM prod_piece"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pièces de Production - Sonasta</title>

    <link rel="icon" type="image/png" href="img/Logo-mini.png">
    

  <link rel="stylesheet" crossorigin href="./assets/compiled/css/app.css">
  <link rel="stylesheet" crossorigin href="./assets/compiled/css/app-dark.css">
  <link rel="stylesheet" crossorigin href="./assets/compiled/css/iconly.css">
  <link rel="stylesheet" href="piece prod.css">
</head>

<body data-bs-theme="light">
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5 no-print">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.html"><img src="img/LogoP.png" alt="Logo"></a>
                        </div>
                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="<?php echo $photo; ?>" alt="Avatar" class="img-fluid rounded-circle">
                                    </div>
                                    <div class="text ms-2">
                                        <h6 class="user-dropdown-name mb-0"><?php echo $name; ?></h6>
                                        <p class="user-dropdown-status text-sm text-muted mb-0"><?php echo $role; ?></p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="account-profile.php">My Account</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="Gestion_emp/logout.php">Logout</a></li>
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
                           
                            <li class="menu-item mx-4">
                                <a class="nav-link" href="piece Prod.html">  Production des pièces mécaniques
                                </a>
                            </li>
                            <li class="menu-item mx-4" >
                                <a href="matieres.php" class='menu-link'>Les matières en Stock
                                </a>
                            </li>
                            <li class="menu-item mx-4" >
                                <a href="Machines.php" class='menu-link'>Informations sur Les Machines de travail
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>                    
            </header>
<!-- Add Modal Start -->
<div class="modal fade text-left" id="Add-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(#4158A6,#3283c1);">
                <h5 class="modal-title white" id="myModalLabel160">Ajouter une Pièce</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="Gestion_emp/insert_piece.php" method="POST" enctype="multipart/form-data" class="form-modern">
    <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
        <!-- Input for Photo de Pièce -->
        <div class="form-group">
            <label for="piece-photo" class="form-label">Photo de Pièce:</label>
            <input id="piece-photo" type="file" name="piece_photo" class="form-control" accept="image/*" required>
        </div>

        <!-- Input for Nom de Pièce -->
        <div class="form-group">
            <label for="piece-name" class="form-label">Nom de Pièce:</label>
            <input id="piece-name" type="text" name="piece_name" placeholder="Enter Piece Name" class="form-control" required>
        </div>
        <!-- Input for Piece Diameter -->
        <div class="form-group">
            <label for="piece-diameter" class="form-label">Diamètre de Pièce:</label>
            <input id="piece-diameter" type="number" name="piece_diameter" placeholder="Enter Piece Diameter (mm)" class="form-control" required>
        </div>

        <!-- Input for Production Date -->
        <div class="form-group">
            <label for="production-date" class="form-label">Date de Production:</label>
            <input id="production-date" type="date" name="production_date" class="form-control" required>
        </div>

        <!-- Input for Sale Date -->
        <div class="form-group">
            <label for="sale-date" class="form-label">Date de Vente:</label>
            <input id="sale-date" type="date" name="sale_date" class="form-control" required>
        </div>

        <!-- Input for Sale Price -->
        <div class="form-group">
            <label for="sale-price" class="form-label">Prix de Vente:</label>
            <input id="sale-price" type="number" name="sale_price" placeholder="Enter Sale Price ($)" class="form-control" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
            <span class="d-none d-sm-block">Close</span>
        </button>
        <button type="submit" class="btn btn-primary ms-1">
            <span class="d-none d-sm-block">Submit</span>
        </button>
    </div>
</form>

        </div>
    </div>
</div>
<!-- Add Modal End -->
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

                                <!-- Modification Modal Start -->
                                <div class="modal fade text-left" id="Mod-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(#4158A6,#3283c1);">
                <h5 class="modal-title white" id="myModalLabel160">Modifier une machine</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="Gestion_emp/update_piece.php" method="POST" enctype="multipart/form-data" class="form-modern">
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">

                    <!-- Hidden input for ID of the Piece -->
                    <input type="hidden" name="piece_id">

                    <!-- Input for Photo de Pièce -->
                    <div class="form-group">
                        <label for="piece-photo" class="form-label">Photo de Pièce:</label>
                        <div class="piece-photo-preview">
                            <!-- Photo preview will be inserted here by JavaScript -->
                        </div>
                        <input id="piece-photo" type="file" name="piece_photo" class="form-control" accept="image/*">
                    </div>

                    <!-- Input for Nom de Pièce -->
                    <div class="form-group">
                        <label for="piece-name" class="form-label">Nom de Pièce:</label>
                        <input id="piece-name" type="text" name="piece_name" placeholder="Enter Piece Name" class="form-control" required>
                    </div>

                    <!-- Input for Piece Diameter -->
                    <div class="form-group">
                        <label for="piece-diameter" class="form-label">Diamètre de Pièce:</label>
                        <input id="piece-diameter" type="number" name="piece_diameter" placeholder="Enter Piece Diameter (mm)" class="form-control" required>
                    </div>

                    <!-- Input for Production Date -->
                    <div class="form-group">
                        <label for="production-date" class="form-label">Date de Production:</label>
                        <input id="production-date" type="date" name="production_date" class="form-control" required>
                    </div>

                    <!-- Input for Sale Date -->
                    <div class="form-group">
                        <label for="sale-date" class="form-label">Date de Vente:</label>
                        <input id="sale-date" type="date" name="sale_date" class="form-control" required>
                    </div>

                    <!-- Input for Sale Price -->
                    <div class="form-group">
                        <label for="sale-price" class="form-label">Prix de Vente:</label>
                        <input id="sale-price" type="number" name="sale_price" placeholder="Enter Sale Price ($)" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <span class="d-none d-sm-block">Modifier</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
                                <!-- Modification Modal End -->
                                <!-- Contant Table Start -->
            <div class="content-wrapper container ">
                <div class="page-heading">
                </div>
                <div class="page-content">
                <main class="table" id="customers_table">
                <section class="table__header no-print">
                    <h3 style="display: flex;justify-content: center;align-items: center;width: 100%;">  Production des pièces mécaniques</h3>
                    <div class="cont">
                        <div class="Add">
                            <img src="img/add.svg" class="Add-btn" data-bs-toggle="modal" data-bs-target="#Add-Modal" alt="Modification Icon">
                        </div>
                        <div class="export__file no-print">
                            <label for="export-file" class="export__file-btn" title="Export File"></label>
                            <input type="checkbox" id="export-file">
                            <div class="export__file-options">
                                <label for="export-file" onclick="printPage()">PDF <img src="images/pdf.png" alt=""></label>
                                <label for="export-file" id="toEXCEL">EXCEL <img src="images/excel.png" alt=""></label>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="card ">
                        <div class="card-body">
                            <table class="table table-hover table-modern" id="table1">
                                <thead>
        <tr>
            <th>Id</th>
            <th>Photo de Pièce</th>
            <th>Nom de Pièce</th>
            <th>Piece Diameter</th>
            <th>Production Date</th>
            <th>Sale Date</th>
            <th>Sale Price</th>
            <th class="no-print"> opération</th>

        </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = htmlspecialchars($row["id"]);
            $photo = htmlspecialchars($row["Photo_Piece"]);
            $name = htmlspecialchars($row["Nom_piece"]);
            $diameter = htmlspecialchars($row["Diameter_Piece"]);
            $prodDate = $row["prod_date"];
            $saleDate = $row["sale_date"];
            $salePrice = htmlspecialchars($row["sale_prix"]);

            echo "<tr>";
            echo "<td>$id</td>";

            if (!empty($photo)) {
                echo "<td><img src='images/$photo' alt='$name' style='width: 50px;'></td>";
            } else {
                echo "<td><button class='more-pics-btn' data-bs-toggle='modal' data-bs-target='#galleryModal' data-bs-slide-to='0'>Voir La Photo</button></td>";
            }

            echo "<td>$name</td>";
            echo "<td>$diameter</td>";
            echo "<td>" . (!empty($prodDate) ? date('d M, Y', strtotime($prodDate)) : 'No production date') . "</td>";
            echo "<td>" . (!empty($saleDate) ? date('d M, Y', strtotime($saleDate)) : 'No sale date') . "</td>";
            echo "<td>$salePrice Dh</td>";

            // Add operation buttons
            echo "<td no-print>
                    <img src='img/trash-2.svg' class='no-print' style='cursor:pointer;padding-left:10px;' alt='Delete Icon' data-bs-toggle='modal' data-bs-target='#Delete-Modal' onclick='setDeleteId($id)'>
 <img src='img/edit.svg'class='no-print' style='cursor:pointer;padding-left:11px;' 
        data-bs-toggle='modal' 
        data-bs-target='#Mod-Modal' 
        alt='Modification Icon' 
        onclick='populateEditModal($id, \"$name\", \"$diameter\", \"$prodDate\", \"$saleDate\", \"$salePrice\", \"$photo\")'>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No data found</td></tr>";
    }
    ?>
</tbody>

    </table>
                            </table>
                        </div>
                    </div>
            
                </section>
            </div>
            
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
<script>  
  let deleteId = null;

function setDeleteId(id) {
    deleteId = id; 
}
// When the confirm delete button is clicked
document.getElementById('confirm-delete-btn').addEventListener('click', function() {
    if (deleteId) {
        // Redirect to the delete PHP script with the machine ID
        window.location.href = 'gestion_emp/delete_piece_prod.php?id=' + deleteId;
    }
});
function populateEditModal(id, name, diameter, prodDate, saleDate, salePrice, photo) {
    document.querySelector('#Mod-Modal input[name="piece_id"]').value = id;
    document.querySelector('#Mod-Modal input[name="piece_name"]').value = name;
    document.querySelector('#Mod-Modal input[name="piece_diameter"]').value = diameter;
    document.querySelector('#Mod-Modal input[name="production_date"]').value = prodDate;
    document.querySelector('#Mod-Modal input[name="sale_date"]').value = saleDate;
    document.querySelector('#Mod-Modal input[name="sale_price"]').value = salePrice;

    if (photo) {
        document.querySelector('#Mod-Modal .piece-photo-preview').innerHTML = `<img src='images/${photo}' alt='Piece Photo' style='width: 100px; margin-bottom: 10px;'>`;
    } else {
        document.querySelector('#Mod-Modal .piece-photo-preview').innerHTML = '';
    }
}
function printPage() {
    // Apply CSS for print settings
    var style = document.createElement('style');
    
    style.innerHTML = `
        @media print {
            @page { size: A3 portrait; }
        }
        .card-body {
            border: 1px solid #fff;
        }
        main.table {
            box-shadow: none;
            background: #fff;
        }
        body {
            background: #fff;
        }
    `;

    // Append the style element to the head
    document.head.appendChild(style);

    // Trigger the print dialog
    window.print();

    // Remove the added styles after printing
    // Optionally, you can remove the style element to clean up after printing
    document.head.removeChild(style);
}

</script>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/static/js/pages/horizontal-layout.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
    <script src="Machines.js"></script>
</body>
</html>