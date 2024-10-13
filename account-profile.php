<?php
session_start();
include 'Operations/conn.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$sql = "SELECT Nom, Email, Tele, Date_emb, Role, Photo FROM gestion_emp WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $phone, $date_emb, $role, $photo);
$stmt->fetch();
$stmt->close();

// Assign fetched data to session variables if needed
$_SESSION['user_name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['tele'] = $phone;
$_SESSION['date_emb'] = $date_emb;
$_SESSION['photo'] = $photo;
$photo = $_SESSION['photo'];

// Default values from session or database
$name = $_SESSION['user_name'] ?? $name;
$email = $_SESSION['email'] ?? $email;
$phone = $_SESSION['tele'] ?? $phone;
$date_emb = $_SESSION['date_emb'] ?? $date_emb;
$photo = $_SESSION['photo'] ?? $photo;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Sonasta</title>
    <link rel="icon" type="image/png" href="img/Logo-mini.png">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="matieres.css">   
</head>
<body data-bs-theme="light">
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
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
                                        <h6 class="user-dropdown-name mb-0"><?php echo htmlspecialchars($name); ?></h6>
                                        <p class="user-dropdown-status text-sm text-muted mb-0"><?php echo htmlspecialchars($role); ?></p>
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
                            <li class="menu-item mx-4">
                                <a href="index.php" class='menu-link'>
                                    <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-item mx-4">
                                <a href="piece%20Prod.html" class='menu-link'>
                                    <span><i class="bi bi"></i> Production des pièces mécaniques</span>
                                </a>
                            </li>
                            <li class="menu-item mx-4">
                                <a href="matieres.html" class='menu-link'>Les matières en Stock</a>
                            </li>
                            <li class="menu-item mx-4">
                                <a class='menu-link' href="Machines.html">Informations sur Les Machines de travail</a>
                            </li>
                        </ul>
                    </div>
                </nav>                    
            </header>

            <!-- Content Table Start -->
            <div class="content-wrapper container">
                <div class="page-heading"></div>
                <div class="page-content">
                    <section class="section">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="avatar avatar-2xl">
                                                <img src="<?php echo htmlspecialchars($photo); ?>" alt="Avatar">
                                            </div>
                                            <h3 class="mt-3"><?php echo htmlspecialchars($name); ?></h3>
                                            <p class="text-small"><?php echo htmlspecialchars($role); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="Gestion_emp/update_user_user.php" method="post">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Nom Complet</label>
                                                <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" class="form-label">Téléphone</label>
                                                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="birthday" class="form-label">Date de naissance</label>
                                                <input type="date" name="birthday" id="birthday" class="form-control" value="<?php echo htmlspecialchars($date_emb); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="role" class="form-label">Role</label>
                                                <select name="role" id="gender" class="form-control">
                                                    <option value="Admin" <?php if ($role == 'Admin') echo 'selected'; ?>>Admin</option>
                                                    <option value="Chef-Service" <?php if ($role == 'Chef-Service') echo 'selected'; ?>>Chef-Service</option>
                                                    <option value="Employé" <?php if ($role == 'Employé') echo 'selected'; ?>>Employé</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Scripts -->
            <script src="assets/static/js/components/dark.js"></script>
            <script src="assets/static/js/pages/horizontal-layout.js"></script>
            <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
            <script src="assets/compiled/js/app.js"></script>
            <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
            <script src="assets/static/js/pages/dashboard.js"></script>
            <script src="matieres.js"></script>
        </div>
    </div>
</body>
</html>
ooo