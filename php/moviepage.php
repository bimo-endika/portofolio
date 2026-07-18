<?php
session_start();
require "koneksi.php";
require "fungsi.php";

$isAdmin = isset($_SESSION['is_logged_in']) &&
           isset($_SESSION['peran']) &&
           $_SESSION['peran'] === 'admin';

$genre = $_GET['genre'] ?? 'Action';
$movieList = getMoviesByGenre($genre);

if(isset($_POST['update_watched'])){

    $movie_id = (int)$_POST['movie_id'];
    $watched = (int)$_POST['watched'];

    updateWatched($movie_id, $watched);

    header("Location: moviepage.php?genre=".$genre);
    exit;
}

if(isset($_POST['delete_movie'])){

    $movie_id = (int)$_POST['movie_id'];

    if(deleteMovie($movie_id) > 0){

        echo "
        <script>
            alert('Movie berhasil dihapus');
            window.location='moviepage.php?genre=".$genre."';
        </script>
        ";

    }else{

        echo "
        <script>
            alert('Movie gagal dihapus');
        </script>
        ";

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($genre) ?> Movie</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/mv_style.css">

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">

    <div class="container">

        <a class="navbar-brand" href="../html/index.html">
            bimoendika.
        </a>

        <button
            class="navbar-toggler"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="halamanutama.php">
                        home
                    </a>
                </li>

                <?php if($isAdmin): ?>

                <li class="nav-item">
                    <a class="nav-link"
                    href="../admin/addmovie.php?genre=<?= urlencode($genre); ?>">
                        Add Movie
                    </a>
                </li>

                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        Logout
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- END NAVBAR -->

<section class="py-5">

<div class="container">

<h1 class="text-center fw-bold mb-5">

<?= htmlspecialchars($genre); ?> Movie

</h1>

<div class="row g-4">

<?php foreach($movieList as $movie): ?>

<div class="col-12 col-sm-6 col-md-4 col-lg-custom">

<div class="card movie-card shadow-sm h-100">

<div class="card-body d-flex flex-column">

<h5 class="movie-title">

<?= htmlspecialchars($movie['movie_name']); ?>

</h5>

<hr>

<p class="movie-desc">

<?= nl2br(htmlspecialchars($movie['deskripsi'])); ?>

</p>

<div class="mt-auto">

<a

href="<?= htmlspecialchars($movie['movie_link']); ?>"

target="_blank"

class="btn btn-primary w-100">

Open Movie

</a>

<?php if($isAdmin): ?>

<form method="POST" class="mt-2">

<input
type="hidden"
name="movie_id"
value="<?= $movie['id']; ?>">

<input
type="hidden"
name="watched"
value="<?= $movie['watched'] ? 0 : 1; ?>">

<button

type="submit"

name="update_watched"

class="btn <?= $movie['watched']
? 'btn-success'
: 'btn-secondary'; ?> w-100">

<?= $movie['watched']
? '✓ Sudah Ditonton'
: 'Mark as Watched'; ?>

</button>

</form>



<!-- Edit + Delete -->

<div class="d-flex gap-2 mt-2">

    <!-- Edit -->
    <a href="../admin/addmovie.php?id=<?= $movie['id']; ?>"
       class="btn btn-warning flex-fill">
        ✏ Edit
    </a>

    <!-- Delete -->
    <form method="POST" class="flex-fill d-grid">

        <input type="hidden"
               name="movie_id"
               value="<?= $movie['id']; ?>">

        <button
            type="submit"
            name="delete_movie"
            class="btn btn-danger"
            onclick="return confirm('Yakin ingin menghapus movie ini?');">

            🗑 Delete

        </button>

    </form>

</div>

<?php endif; ?>

</div>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>