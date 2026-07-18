<?php
session_start();
require "../php/koneksi.php";
require "../php/fungsi.php";

if (!isset($_SESSION['is_logged_in']) || $_SESSION['peran'] !== 'admin') {
    echo "<script>
        alert('Akses admin ditolak.');
        window.location.href='../php/login.php';
    </script>";
    exit();
}

if(isset($_POST['tambah_movie'])){

    $hasil = addMovie(
        $_POST['genre_id'],
        $_POST['movie_name'],
        $_POST['movie_link'],
        $_POST['deskripsi']
    );

    if($hasil > 0){
        echo "
        <script>
            alert('Movie berhasil ditambahkan');
            document.location.href='../php/halamanutama.php';
        </script>";
    }else{
        echo "
        <script>
            alert('Movie gagal ditambahkan');
        </script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addmovie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mv_style.css">
</head>
<body>
      <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
      <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="#home">bimoendika.</a>

        <!-- Navbar Toggle untuk hp -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Link -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <!-- Home Link -->
            <li class="nav-item">
              <a class="nav-link active" href="#">home</a>
            </li>
<li class="nav-item">
              <a class="nav-link" href="../admin/addmovie.php">addmovie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="moviepage.php">lihat sebagai tamu</a>
            </li>


            <!-- My last work Link -->
            <li class="nav-item">
              <a class="nav-link" href="../php/logout.php">logout</a>
            </li>

          </ul>
        </div>
      </div>
    </nav><br>
    <!-- NAVBAR END -->



    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <section class="mb-5 p-3 bg-white rounded shadow-sm">
                    <h3 class="mb-3 h5">Tambah Movie Baru (<?php echo htmlspecialchars($genre); ?>)</h3>
                    <form method="POST">
                        <input type="hidden" name="genre" value="<?php echo htmlspecialchars($genre); ?>" />

                        <div class="mb-3">
                            <label class="form-label">Movie Name</label>
                            <input type="text" class="form-control form-control-sm" name="movie_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">genre</label>
                            <select class="form-control form-control-sm" name="genre_id" required>
                                <option value="">Pilih Genre</option>
                                <option value="1">Action</option>
                                <option value="2">Comedy</option>
                                <option value="3">Drama</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="url" class="form-control form-control-sm" name="link_genre" placeholder="https://..." >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control form-control-sm" name="deskripsi" rows="3" placeholder="Deskripsi movie"></textarea>
                        </div>

                        <button type="submit" name="tambah_movie" value="1" class="btn btn-primary btn-sm">Tambah</button>
                    </form>
                </section>
            </div>
        </div>
    </div>

</body>
</html>

