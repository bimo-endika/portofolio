<?php
session_start();
require('koneksi.php');
require('fungsi.php');

if (isset($_SESSION['is_logged_in'])) {
    header("Location: halamanutama.php");
    exit();
}

$error = '';
if (isset($_POST['login'])) {
    $hasilLogin = login($_POST);

    if ($hasilLogin == 1) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['is_logged_in'] = true;
        $_SESSION['peran'] = 'admin';
        echo "<script>
            alert('Login Berhasil!!!');
document.location.href='halamanutama.php';
        </script>";
        exit();
    } elseif ($hasilLogin == 0) {
        $error = 'Username atau password salah.';
    } else {
        $error = 'Akun tidak ditemukan.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/mv_style.css">
</head>
<body class="bg-light">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
      <div class="container">
        <a class="navbar-brand" href="#home">bimoendika.</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../php/login.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="d-flex justify-content-center align-items-center min-vh-100 px-3">
        <div class="card shadow-sm border-0" style="width: 100%; max-width: 420px;">
            <div class="card-body p-4 p-md-5">
                <h2 class="card-title text-center mb-2">Welcome Back</h2>
                <p class="text-muted text-center mb-4">Silakan masuk ke akun Anda</p>

                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="admin" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="admin" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>

                    <button type="submit" name="login" value="1" class="btn btn-primary w-100">Sign In</button>
                </form>
                <a class="btn btn-secondary w-100 mt-2" href="halamanutama.php">lihat sebagai tamu</a>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>