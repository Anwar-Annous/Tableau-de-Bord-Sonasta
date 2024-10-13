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
                                                    <h6 class="font-extrabold mb-0">4</h6>
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
                                                    <h6 class="font-extrabold mb-0">4</h6>
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
                                                    <h6 class="font-extrabold mb-0">5</h6>
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
                        <div class="col-12 col-lg-3">
                            <a href="Gestion_Emp.php">
                                <div class="card gestion-card">
                                    <div class="card-body py-4 px-5">
                                        <div class="d-flex align-items-center">
                                            <span>
                                                <svg width="50" height="50px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>user-settings-filled</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="icon" fill="#000000" transform="translate(64.000000, 42.666667)"> <path d="M328.180488,213.333333 L328.181163,236.169297 C338.584391,239.846405 348.098741,245.405183 356.315274,252.43669 L376.112086,241.006655 L405.741716,292.326679 L385.957797,303.749991 C386.931071,309.018468 387.439747,314.44983 387.439747,320 C387.439747,325.550277 386.931052,330.981742 385.957741,336.250315 L405.741716,347.673321 L376.112086,398.993345 L356.315274,387.56331 C348.098741,394.594817 338.584391,400.153595 328.181163,403.830703 L328.180488,426.666667 L268.921228,426.666667 L268.920553,403.830703 C258.51771,400.153731 249.00368,394.595229 240.787356,387.564092 L220.98963,398.993345 L191.36,347.673321 L211.143975,336.250315 C210.170664,330.981742 209.661969,325.550277 209.661969,320 C209.661969,314.449479 210.170709,309.017781 211.144103,303.74899 L191.36,292.326679 L220.98963,241.006655 L240.786362,252.436758 C249.002913,245.405219 258.517291,239.846417 268.920553,236.169297 L268.921228,213.333333 L328.180488,213.333333 Z M186.666667,192 C206.101493,192 224.380148,197.091591 240.310579,206.048663 C198.959113,227.266184 170.666667,270.329064 170.666667,320 C170.666667,343.314131 176.899769,365.172443 187.790443,383.999404 L-1.42108547e-14,384 L-1.42108547e-14,307.2 C-1.42108547e-14,245.167377 47.6682427,194.586369 107.383368,192.096089 L112,192 L186.666667,192 Z M298.550858,284.444444 C278.914067,284.444444 262.995302,300.363209 262.995302,320 C262.995302,339.636791 278.914067,355.555556 298.550858,355.555556 C318.187649,355.555556 334.106413,339.636791 334.106413,320 C334.106413,300.363209 318.187649,284.444444 298.550858,284.444444 Z M149.333333,7.10542736e-15 C190.570595,7.10542736e-15 224,33.4294053 224,74.6666667 C224,114.529353 192.762078,147.096031 153.430084,149.222851 L149.333333,149.333333 C108.096072,149.333333 74.6666667,115.903928 74.6666667,74.6666667 C74.6666667,34.8039807 105.904589,2.23730242 145.236582,0.110482405 L149.333333,7.10542736e-15 Z" id="Combined-Shape"> </path> </g> </g> </g></svg>
                                            </span> 
                                            <div class="ms-3 name">
                                                <p class="gestion-title"> Gestion des Employés</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a> 
                    </section>

                    <section class="row gy-4 px-4 g-xl-8 mb-6 mt-2" >
                        <div class="card-body p-0">
                            <a href="piece Prod.php" class="cardi" >
                                <div class="position-relative ">
                                    <div class="d-flex gap-4 tab-scroll">
                                        <div class="card bg-danger w-100 w-md-50 w-lg-33 tab-head hoverable item border-bottom-4" >
                                            <div class="card-body p-md-5 p-lg-6" href="#">
                                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1"  >
                                                    <img src="img/icon1dash.svg" alt="">
                                                </span> 
                                                <div class="text-white text-center fw-bold fs-2 mb-2 mt-3 ws-nw" data-v-ab067974="">
                                                    Production des pièces mécaniques
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
                        <div class="card bg-info w-100 w-md-50 w-lg-33 tab-head hoverable item" data-v-ab067974="">
                            <a href="matieres.php" class="cardi" >
                                <div class="card-body p-md-5 p-lg-6" data-v-ab067974="">
                                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1"  >
                                        <img src="img/icon3dash.svg" alt="">
                                    </span> 
                                    <div class="text-white text fw-bold fs-2 mb-2 mt-3 ws-nw text-center" data-v-ab067974=""> 
                                        Les matières en Stock
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