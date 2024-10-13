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
    <title>Dashboard - Sonasta</title>
    <link rel="icon" type="image/png" href="img/Logo-mini.png">

  <link rel="stylesheet" crossorigin href="./assets/compiled/css/app.css">
  <link rel="stylesheet" crossorigin href="./assets/compiled/css/app-dark.css">
  <link rel="stylesheet" crossorigin href="./assets/compiled/css/iconly.css">
  <link rel="stylesheet" href="index.css">
</head>

<body data-bs-theme="light">    <script src="assets/static/js/initTheme.js"></script>
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
                                                <h6 class="user-dropdown-name"> 
                                                    <?php
                                                    echo  $name;
                                                     ?>
                                                </h6>



                                        <p class="user-dropdown-status text-sm text-muted">
                                        <?php
                                                    echo  $role;
                                                     ?>
                                        </p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="account-profile.php">My Account</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="login.php">Logout</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar ">
                    <div class="container">
                        <ul class="navbar-nav mx-auto">
                            <li class="menu-item mx-4">
                                <a href="index.php" class='menu-link'>
                                    <span>Dashboard</span>
                                </a>
                            </li>   
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="content-wrapper container">           
                <div class="page-heading">
                    <h3>Have a good day 
                    <?php 
                    echo  $name;
                        ?> !
                    </h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="col-12 col-lg-9">
                            <div class="row">
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="iconly-boldShow"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold"> admin Comptes</h6>
                                                    <h6 class="font-extrabold mb-0">0</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon bg-info mb-2">
                                                        <i class="iconly-boldProfile"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Chefs des services Comptes</h6>
                                                    <h6 class="font-extrabold mb-0">0</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="iconly-boldAdd-User" ></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Employés Comptes</h6>
                                                    <h6 class="font-extrabold mb-0">0</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Remarques</h6>
                                                    <h6 class="font-extrabold mb-0">0</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="row gy-4 px-4 g-xl-8 mb-6 mt-2" >
                        <div class="card-body p-0">
                        <a href="matieres.php" class="cardi" >
                        <div class="position-relative ">
                                    <div class="d-flex gap-4 tab-scroll">
                                        <div class="card bg-info w-100 w-md-50 w-lg-33 tab-head hoverable item border-bottom-4" >
                                            <div class="card-body p-md-5 p-lg-6" href="#">
                                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1"  >
                                                <img src="img/icon3dash.svg" alt="">
                                                </span> 
                                                <div class="text-white text fw-bold fs-2 mb-2 mt-3 ws-nw text-center" data-v-ab067974=""> 
                                        Les matières en Stock
                                    </div>
                                            </div>
                            </a>
                        </div> 
                      

                        <div class="card bg-primary w-100 w-md-50 w-lg-33 tab-head hoverable item" data-v-ab067974="" >
                            <a href="Machines.php" class="cardi">
                                <div class="card-body p-md-5 p-lg-6" data-v-ab067974="">
                                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1"  >
                                        <img src="img/icon2dash.svg" alt="">
                                    </span> 
                                    <div class="text-white fw-bold fs-2 mb-2 mt-3  text-center ws-nw" data-v-ab067974="">
                                        Les machines
                                    </div> 
                                </div>
                            </a>
                        </div> 
                       
                    </section>
                </div>
        <div class="row mt-4">
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Dernière Remarques</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Remarque</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    <img src="./assets/compiled/jpg/5.jpg">
                                                </div>
                                                <p class="font-bold ms-3 mb-0">xxxx</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">xxxxxxxxxxxx</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    <img src="./assets/compiled/jpg/2.jpg">
                                                </div>
                                                <p class="font-bold ms-3 mb-0">xxxxxxxxxxxx</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">xxxxxxx</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

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
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/static/js/pages/horizontal-layout.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
    
</body>

</html>