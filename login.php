<?php
include 'Operations/conn.php';

session_start(); // Start the session

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($conn, $_POST['worker-user']);
    $pass = mysqli_real_escape_string($conn, $_POST['worker-pass']);

    // Prepare the SQL query
    $sql = "SELECT ID, photo, pass, Nom, Role FROM gestion_emp WHERE user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $photo, $stored_pass, $nom, $role);
        $stmt->fetch();

        // Compare passwords
        if ($pass === $stored_pass) {
            // Store data in the session
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $nom;
            $_SESSION['user_role'] = $role;
            $_SESSION['photo'] = $photo;

            // Redirect to index.php
            header('Location: index.php');
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sonasta</title>
    <link rel="icon" type="image/png" href="img/Logo-mini.png">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/auth.css">
</head>
<body data-bs-theme="light">
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.php"><img src="img/LogoP.png" alt="Logo"></a>
                    </div>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                    <form action="login.php" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="worker-user" class="form-control form-control-xl" placeholder="Username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="worker-pass" class="form-control form-control-xl" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                            Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Log in</button>
                    </form>

                    <div class="text-center mt-3 text-lg fs-4">
                        <p>
                            <a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img src="img/1725828226948.png" style="height: 100%; margin-left: 0%;">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
