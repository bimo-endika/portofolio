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
            <h2 class="title-box">MY MOVIE LIBRARY</h2>
        </div>

        <!-- Grid 2x2 untuk Tumpukan Kartu -->
        <div class="row gx-5 gy-5 mb-5"> <!-- gy-5 memberi jarak vertikal antar baris -->
            
            <!-- Kolom 1 (Kiri Atas) -->
<div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Comedy"><h4 class="title-box ">comedy movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2025/11/01/2bb1dac54e777749acbef82fdf538675.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2025/06/15/3dab36e59c110f6a6d8b983cbd60cd7e.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/93f1181f92c3ddf3ad5f2751c20aded7.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2025/11/01/628d4d8a9f5c798e41e6584298581a13.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

            <!-- Kolom 2 (Kanan Atas) -->
            <div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Action"><h4 class="title-box ">action movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/e780c957f47ad7c494016bae8d0836f6.jpg?x-oss-process=image/resize%2Cw_250/format%2Cwebp" class="card-img-top" alt="John Wick">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/358a1e7bf1fe43eec8e1ce7386cea9c2.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/edd42613fb50bad2e5552966a0d6cba1.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" >
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/05/13/7f325ae24664d74d63a53ebc052b29d2-s.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" >
                    </div>
                </div>
            </div>

            <!-- Kolom 3 (Kiri Bawah) -->
<div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Drama"><h4 class="title-box ">drama movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2025/12/04/1bc53c613f4f3baab21c37881cbe794b.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/57ba1023dc0a150a6385b5fa53985528.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/c3cdfeecdec5ee8a9e179c26ac84af96.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/00a0efcb7b18b3940221a850a30adb5b.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

            <!-- Kolom 4 (Kanan Bawah) -->
            <div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Romance"><h4 class="title-box ">romance movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/26/1598ead71eb603755179c735d15935da.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                        <p class="card-text text-center"></p>
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/26/07c4cb50c7b38ff1a725b1367d324d07.jpg?x-oss-process=image/resize%2Cw_300"card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/0e7c343060fbdbcc413f0d2bed684c7d.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/6e971a228e70a1b481981fac3b92518c.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

             <!-- Kolom 5 (Kanan Bawah) -->
            <div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Horror"><h4 class="title-box ">horror movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/44576ad439029bc9031f4e13c0a234dd.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                        <p class="card-text text-center"></p>
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2023/08/11/eb7e23ded51f3851854f8ec9290605a6.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2023/08/10/411da0d2b8f0d228ddc20407fd225997.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/26/80097da0b511bad437de514063a1134c.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>
        
             <!-- Kolom 6 (Kanan Bawah) -->
            <div class="col-md-6 d-flex flex-column align-items-center">
<a class="text-decoration-none" href="moviepage.php?genre=Series"><h4 class="title-box ">series movie</h4></a>

                <div class="card-stack-container">
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2025/12/04/3891fe18cdef5199869d2b044b1ab995.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                        <p class="card-text text-center"></p>
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/04/29/c23ca8f0058657b63ddc6c8517ca1ee3.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2025/12/04/4c7718d58875427abf19666287ecfbfa.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                    <div class="card card-stacked">
                        <img src="https://pbcdnw.aoneroom.com/image/2026/01/27/ca1ceb1c8e9a9b51f10694881bd6b5c8.jpg?x-oss-process=image/resize%2Cw_300" class="card-img-top" alt="Img">
                    </div>
                </div>
            </div>

        </div> <!-- Akhir Grid -->

    </div> <!-- Akhir Container -->


    <!-- Script Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>