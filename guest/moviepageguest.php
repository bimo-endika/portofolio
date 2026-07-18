<?php
session_start();
require "../php/koneksi.php";
require "../php/fungsi.php";

$genre = $_GET['genre'] ?? 'Action';
$movieList = getMoviesByGenreKey($genre);
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
        <!-- Brand Logo -->
        <a class="navbar-brand" href="../php/halamanutama.php">bimoendika.</a>

        <!-- Navbar Toggle untuk hp -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Link -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <!-- Home Link -->
            <li class="nav-item">
              <a class="nav-link active" href="../php/halamanutama.php">Movie Library</a>
            </li>

            <!-- My last work Link -->
            <li class="nav-item">
              <a class="nav-link" href="../php/logout.php">logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- GAMBAR 2: Kartu Berbeda tapi Efek Hover Sama (Grid) -->
    <section class="mb-5">
        <h2 class="mb-4">Movie Type / Playlist: <?php echo htmlspecialchars($genre); ?></h2>

        <div class="row g-4">
            <?php if (count($movieList) === 0) : ?>
                <div class="col-12">
                    <div class="alert alert-warning">Movie tidak ditemukan untuk genre ini.</div>
                </div>
            <?php else : ?>
                <?php foreach ($movieList as $movie) : ?>
                    <div class="col-md-3">
                        <div class="card card-hover h-100">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Img">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($movie['movie_name']); ?></p>
                                <p class="card-text"> </p>
                                <a class="btn btn-sm btn-primary" href="<?php echo htmlspecialchars($movie['link_genre']); ?>" target="_blank">Open</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>

