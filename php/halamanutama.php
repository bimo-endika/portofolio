<?php
require "fungsi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Library</title>
    <!-- Memuat Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mv_style.css">
</head>
<body class="bg-light">

     <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
      <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="../html/index.html">bimoendika.</a>

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


            <!-- My last work Link -->
            <li class="nav-item">
              <a class="nav-link" href="../php/logout.php">logout</a>
            </li>

          </ul>
        </div>
      </div>
    </nav><br>
    <!-- NAVBAR END -->

    <div class="container">
        
        <!-- Judul Utama (Movie Library) -->
        <div class="d-flex justify-content-center mb-5">
            <h2 class="title-box">MOVIE LIBRARY</h2>
        </div>

        <!-- Grid 2x2 untuk Tumpukan Kartu -->
        <div class="row gy-5 mb-5"> <!-- gy-5 memberi jarak vertikal antar baris -->
            
            <!-- Kolom 1 (Kiri Atas) -->
<div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Comedy"><h4 class="title-box w-75 mb-3">comedy movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

            <!-- Kolom 2 (Kanan Atas) -->
            <div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Action"><h4 class="title-box w-75 mb-3">action movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

            <!-- Kolom 3 (Kiri Bawah) -->
<div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Drama"><h4 class="title-box w-75 mb-3">drama movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

            <!-- Kolom 4 (Kanan Bawah) -->
            <div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Romance"><h4 class="title-box w-75 mb-3">romance movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="../images/gamedev.png" class="card-img-top p-2" alt="Img">
                        <p class="card-text text-center"></p>
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

             <!-- Kolom 5 (Kanan Bawah) -->
            <div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Horror"><h4 class="title-box w-75 mb-3">horror movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="../images/gamedev.png" class="card-img-top" alt="Img">
                        <p class="card-text text-center"></p>
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

             <!-- Kolom 6 (Kanan Bawah) -->
            <div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Series"><h4 class="title-box w-75 mb-3">series movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="../images/gamedev.png" class="card-img-top" alt="Img">
                        <p class="card-text text-center"></p>
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://via.placeholder.com/180x250" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

        </div> <!-- Akhir Grid -->

    </div> <!-- Akhir Container -->


    <!-- Script Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>