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

$genre = $_GET['genre'] ?? 'Action';
$username = $_SESSION['username'] ?? '';

$movieList = getMoviesByGenreKey($genre);
$watchedIds = getWatchedMovieIds($username, $genre);
$watchedMap = [];
foreach ($watchedIds as $id) {
    $watchedMap[(int)$id] = true;
}

if (isset($_POST['simpan_watched']) && isset($_POST['movie_id'])) {
    $movieId = (int)($_POST['movie_id']);
    $ditonton = isset($_POST['ditonton']) ? 1 : 0;
    setWatched($username, $genre, $movieId, $ditonton);

    echo "<script>
        alert('Status ditonton tersimpan');
        window.location.href='moviepageadmin.php?genre=" . htmlspecialchars($genre) . "';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>movie page admin</title>
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
            <li class="nav-item">
              <a class="nav-link active" href="../php/halamanutama.php">Movie Library</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="addmovie.php?genre=<?php echo htmlspecialchars($genre); ?>">add movie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../php/logout.php">logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="mb-5" style="padding-top:20px;">
        <h2 class="mb-4">Admin Movie: <?php echo htmlspecialchars($genre); ?></h2>

        <div class="row g-4">
            <?php if (count($movieList) === 0) : ?>
                <div class="col-12">
                    <div class="alert alert-warning">Movie tidak ditemukan untuk genre ini.</div>
                </div>
            <?php else : ?>
                <?php foreach ($movieList as $movie) : 
                    $id = (int)$movie['id'];
                    $checked = isset($watchedMap[$id]);
                ?>
                    <div class="col-md-3">
                        <div class="card card-hover h-100">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Img">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($movie['movie_name']); ?></p>

                                <form method="post" style="margin-top:8px;">
                                    <input type="hidden" name="movie_id" value="<?php echo $id; ?>" />
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="ditonton" value="1" id="chk_<?php echo $id; ?>" <?php echo $checked ? 'checked' : ''; ?> />
                                        <label class="form-check-label" for="chk_<?php echo $id; ?>">Sudah ditonton</label>
                                    </div>
                                    <button type="submit" name="simpan_watched" value="1" class="btn btn-sm btn-success mt-2">Simpan</button>
                                </form>

                                <a class="btn btn-sm btn-primary mt-2" href="<?php echo htmlspecialchars($movie['link_genre']); ?>" target="_blank">Open</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="mt-4">
            <a class="btn btn-outline-primary" href="addmovie.php?genre=<?php echo htmlspecialchars($genre); ?>">Tambah film baru</a>
        </div>
    </section>
</body>
</html>

