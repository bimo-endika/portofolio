<?php
session_start();
require "koneksi.php";
require "fungsi.php";

$isAdmin = isset($_SESSION['is_logged_in'])
    && isset($_SESSION['peran'])
    && $_SESSION['peran'] === 'admin';
    
$genre = $_GET['genre'] ?? 'Action';
$movieList = getMoviesByGenre($genre);


if(isset($_POST['update_watched'])){

    $movie_id = (int)$_POST['movie_id'];

    $watched = (int)$_POST['watched'];

    updateWatched($movie_id, $watched);

    header("Location: moviepage.php?genre=".$genre);
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>movie page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
      <div class="container">
        <a class="navbar-brand" href="halamanutama.php">bimoendika.</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="halamanutama.php">Movie Library</a>
            </li>

            <?php if ($isAdmin) : ?>
              <li class="nav-item">
                <a class="nav-link" href="../admin/addmovie.php?genre=<?php echo htmlspecialchars($genre); ?>">add movie</a>
              </li>
            <?php endif; ?>

            <li class="nav-item">
              <a class="nav-link" href="logout.php">logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- NAVBAR END -->

<section class="mb-5">
        <h2 class="mb-4"> <?php echo htmlspecialchars($genre); ?> movie</h2><br>

        <div class="row movie-grid g-2">

<?php foreach($movieList as $movie): ?>

<div class="col-12 col-sm-6 col-md-4 col-lg-2">

    <div class="card movie-card shadow-sm">


        <div class="card-body d-flex flex-column">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-start">
                <h5 class="movie-title">
                    <?= htmlspecialchars($movie['movie_name']); ?>
                </h5>
                <?php if($isAdmin): ?>
                <form  class="container" method="POST">
                    <input type="hidden" name="movie_id"value="<?= $movie['id']; ?>">
                    <input type="hidden" name="watched" value="<?= $movie['watched'] ? 0 : 1; ?>">
            </div>
            <hr>
            <!-- Deskripsi -->
            <p class="movie-desc">
                <?= nl2br(htmlspecialchars($movie['deskripsi'])); ?>
            </p>
            <!-- Tombol -->
            <div class="mt-auto">
                <a href="<?= htmlspecialchars($movie['movie_link']); ?>"
                   target="_blank"
                   class="btn btn-primary w-100">
                    Open Movie
                </a>
            </div>
            <div>
                <button type="submit" name="update_watched" class="btn btn-secondary w-100 mt-2">
                    <?= $movie['watched'] ? 'Mark as Unwatched' : 'Mark as Watched'; ?>
                </button>
            </div>
          </form>
            <?php endif; ?>
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

