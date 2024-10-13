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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Des Employés</title>
    <link rel="icon" type="image/png" href="img/Logo-mini.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="gestion_Emp.css">
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
                                <a class="menu-link" href="piece Prod.php">  Production des pièces mécaniques
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
                            <h5 class="modal-title white" id="myModalLabel160">Ajouter un utilisateur</h5>
                        </div>
                        <form action="submit_form.php" method="post" enctype="multipart/form-data" class="form-modern">
                            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                <!-- ID Input -->
                                <div class="form-group">
                                    <label for="worker-id-add" class="form-label">ID :</label>
                                    <input id="worker-id-add" name="worker-id" type="number" placeholder="Entrez l'ID du salarié" class="form-control" readonly>
                                </div>
                                <!-- Photo Input -->
                                <div class="form-group">
                                    <label for="worker-photo-add" class="form-label">Photo :</label>
                                    <input id="worker-photo-add" name="worker-photo" type="file" class="form-control" accept="image/*">
                                </div>
                                <!-- nom Input -->
                                <div class="form-group">
                                    <label for="worker-name-add" class="form-label">Nom :</label>
                                    <input id="worker-name-add" name="worker-name" type="text" placeholder="Entrez le nom" class="form-control">
                                </div>
                                <!-- Email Input -->
                                <div class="form-group">
                                    <label for="worker-email-add" class="form-label">Email :</label>
                                    <input id="worker-email-add" name="worker-email" type="email" placeholder="Entrez l'email" class="form-control">
                                </div>
                                <!-- Telephone Input -->
                                <div class="form-group">
                                    <label for="worker-phone-add" class="form-label">Téléphone :</label>
                                    <input id="worker-phone-add" name="worker-phone" type="tel" placeholder="Entrez le numéro de téléphone" class="form-control">
                                </div>
                                <!-- Role Input -->
                                <div class="form-group">
                                    <label for="worker-role-add" class="form-label">Rôle :</label>
                                    <select id="worker-role-add" name="worker-role" class="form-control">
                                        <option value="Employé">Employé</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Chef Service">Chef Service</option>
                                    </select>
                                </div>
                                <!-- Date d'embauche Input -->
                                <div class="form-group">
                                    <label for="hire-date-add" class="form-label">Date d'embauche :</label>
                                    <input id="hire-date-add" name="hire-date" type="date" class="form-control">
                                </div>
                                <!-- Username Input -->
                                <div class="form-group">
                                    <label for="worker-user-add" class="form-label">Username :</label>
                                    <input id="worker-user-add" name="worker-user" type="text" placeholder="Entrez le Nome d'utilisateur" class="form-control">
                                </div>
                                <!-- Mot de pass Input -->
                                <div class="form-group">
                                    <label for="worker-pass-add" class="form-label">Mot de pass :</label>
                                    <input id="worker-pass-add" name="worker-pass" type="password" placeholder="Entrez le mot de pass" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Fermer</span>
                                </button>
                                <button type="submit" class="btn btn-primary ms-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Ajouter</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                                                            <!-- Add Modal End -->

                                                            <!-- Image Modal Start -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal2-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img id="modal-image" src="" alt="Image Preview">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
                                                            <!-- Edit Modal Start -->

            <div class="modal fade text-left" id="Mod-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(#4158A6, #3283c1);">
                            <h5 class="modal-title white" id="myModalLabel160">Modifier un Profil</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form id="update-form" action="Gestion_emp/update_record.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                <!-- Champ pour l'ID -->
                                <div class="form-group">
                                    <label for="worker-id" class="form-label">ID :</label>
                                    <input id="worker-id" name="id" type="number" class="form-control" readonly>
                                </div>
                                <!-- Photo Input -->
                                <div class="form-group">
                                    <label for="worker-photo" class="form-label">Photo :</label>
                                    <input id="worker-photo" name="photo" type="file" class="form-control" accept="image/*">
                                </div>
                                <!-- Champ pour le Nom -->
                                <div class="form-group">
                                    <label for="worker-name" class="form-label">Nom :</label>
                                    <input id="worker-name" name="name" type="text" class="form-control" required>
                                </div>
                                <!-- Champ pour l'Email -->
                                <div class="form-group">
                                    <label for="worker-email" class="form-label">Email :</label>
                                    <input id="worker-email" name="email" type="email" class="form-control" required>
                                </div>
                                <!-- Champ pour le Téléphone -->
                                <div class="form-group">
                                    <label for="worker-phone" class="form-label">Téléphone :</label>
                                    <input id="worker-phone" name="phone" type="tel" class="form-control" required>
                                </div>
                                <!-- Champ pour le Rôle -->
                                <div class="form-group">
                                    <label for="worker-role" class="form-label">Rôle :</label>
                                    <select id="worker-role" name="role" class="form-control" required>
                                        <option value="Employé">Employé</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Chef Service">Chef Service</option>
                                    </select>
                                </div>
                                <!-- Champ pour la Date d'embauche -->
                                <div class="form-group">
                                    <label for="hire-date" class="form-label">Date d'embauche :</label>
                                    <input id="hire-date" name="date_emb" type="date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="worker-password" class="form-label">Mot de Passe :</label>
                                    <input id="worker-password" name="password" type="password" class="form-control" placeholder="Mise à jour du mot de passe">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Fermer</span>
                                </button>
                                <button type="submit" class="btn btn-primary ms-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Mise a jourer </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                                                            <!-- Edit Modal End -->
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
                                                
                                                    <!-- Start User/pass modal -->
            <div class="modal fade" id="sec-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(#4158A6,#3283c1);">
                            <h5 class="modal-title" id="exampleModalLabel">Des Donnees Privé</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div style="display: flex; margin-top: 25px; margin-left: 20px;">
                                <p class="p-Sec-Modal-primary">Username :</p>
                                <p class="p-Sec-Modal-secondary" id="modal-username">xxxxxxx</p>
                            </div>
                            <div style="display: flex; margin-top: 10px; margin-left: 20px;">
                                <p class="p-Sec-Modal-primary">Password :</p>
                                <p class="p-Sec-Modal-secondary" id="modal-password">xxxxxxx</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Fermer</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

                                            <!-- Contant Table Start -->
            <div class="content-wrapper container">
                <div class="page-heading">
                </div>
                <div class="page-content">
                    <section class="table__header">
                        <h3 style="display: flex;justify-content: center;align-items: center;width: 100%; margin-bottom: 70px; color: #25396f;">Gestion des Employés</h3>
                        <div class="cont">
                            <div class="Add">
                                <button class="noselect btn-1" data-bs-toggle="modal" data-bs-target="#Add-Modal" >
                                <span class="text">Ajouter</span><span class="icon"><svg viewBox="0 0 24 24" height="24"width="24"xmlns="http://www.w3.org/2000/svg"></svg><span class="buttonSpan">+</span></span>
                                </button>
                            </div>
                        </div>
                    </section>
                    <section class="section"> 
                        <div class="card ">
                            <?php
                                include 'Gestion_emp/conn.php';
                                $query = "SELECT * FROM gestion_emp"; 
                                $result = mysqli_query($conn, $query);
                            ?>
                            <table class="table table-hover table-modern" id="table1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Rôle</th>
                                        <th>Date d'embauche</th>
                                        <th>Opérations</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                 while ($row = mysqli_fetch_assoc($result)): 
                                 ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['ID']); ?></td>
                                        <td><img src="<?php echo htmlspecialchars($row['Photo']); ?>" 
                                            style="height: auto; width: 15%; cursor: pointer;" 
                                            alt="Photo" 
                                            data-toggle="modal" 
                                            data-target="#imageModal"
                                            onclick="updateModalImage(this.src)"></td>
                                        <td><?php echo htmlspecialchars($row['Nom']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Tele']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Role']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Date_emb']); ?></td>
                                        <td>
                                            <a  onclick="editRecord(
                                                <?php echo htmlspecialchars($row['ID']); ?>,
                                                '<?php echo htmlspecialchars($row['Photo']); ?>',
                                                '<?php echo htmlspecialchars($row['Nom']); ?>',
                                                '<?php echo htmlspecialchars($row['Email']); ?>',
                                                '<?php echo htmlspecialchars($row['Tele']); ?>',
                                                '<?php echo htmlspecialchars($row['Role']); ?>',
                                                '<?php echo htmlspecialchars($row['Date_emb']); ?>'
                                            )"><img src="img/edit.svg" style="cursor:pointer; padding-left:11px;" alt="Modification Icon">
                                            </a>
                                            <a onclick="confirmDelete(<?php echo htmlspecialchars($row['ID']); ?>)">
                                            <img src="img/trash-2.svg" style="cursor:pointer;padding-left:10px;" alt="Delete Icon">
                                            </a>
                                            <a onclick="showSecureData(<?php echo htmlspecialchars($row['ID']); ?>)">
                                            <img src="img/secure.svg" style="cursor:pointer; padding-left:11px;" data-bs-toggle="modal" data-bs-target="#sec-Modal" alt="Secure Icon">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
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
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/static/js/pages/horizontal-layout.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
    <script src="Machines.js"></script>
    <script>
        function editRecord(id, photo, name, email, phone, role, date) {
            // Populate the modal fields with the record's data
            document.getElementById('worker-id').value = id;
            document.getElementById('worker-photo').value = ''; // Reset file input (can’t set programmatically)
            document.getElementById('worker-name').value = name;
            document.getElementById('worker-email').value = email;
            document.getElementById('worker-phone').value = phone;
            document.getElementById('worker-role').value = role;
            document.getElementById('hire-date').value = date;

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('Mod-Modal'), {
                keyboard: false
            });
            myModal.show();
        }

        function confirmDelete(id) {
            // Show confirmation modal
            var deleteModal = new bootstrap.Modal(document.getElementById('Delete-Modal'), {
                keyboard: false
            });
            document.getElementById('confirm-delete-btn').setAttribute('onclick', 'deleteRecord(' + id + ')');
            deleteModal.show();
        }

        function deleteRecord(id) {
            // Redirect to a PHP script to handle deletion
            window.location.href = 'Gestion_emp/delete_record.php?id=' + id;
        }
        function showSecureData(employeeId) {
            $.ajax({
                url: 'Gestion_emp/fetch_employee.php',
                type: 'GET',
                data: { id: employeeId },
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        $('#modal-username').text(response.username);
                        $('#modal-password').text(response.password);
                    }
                },
                error: function() {
                    alert('An error occurred while fetching data.');
                }
            });
        }
        function updateModalImage(src) {
                document.getElementById('modal-image').src = src;
            }
    </script>
</body>
</html>