<?php
require "koneksi.php";

function login($akun){
    global $koneksi;

    $username = mysqli_real_escape_string($koneksi, $akun['username'] ?? '');
    $password = mysqli_real_escape_string($koneksi, $akun['password'] ?? '');

    if (empty($username) || empty($password)) {
        return 0;
    }

    $cekLoginUser = "SELECT username, password FROM tbl_user WHERE username = '$username' LIMIT 1";
    $hasilCekLoginUser = mysqli_query($koneksi, $cekLoginUser);

    if (!$hasilCekLoginUser || mysqli_num_rows($hasilCekLoginUser) != 1) {
        return -1;
    }

    // pastikan field password ada


    $cekPassword = mysqli_fetch_assoc($hasilCekLoginUser);

    if (password_verify($password, $cekPassword['password']) || $password === $cekPassword['password']) {
        return 1;
    }

    return 0;
}

function addMovie($genre_id, $movie_name, $movie_link, $deskripsi){
    global $koneksi;

    $genre_id = (int)$genre_id;
    $movie_name = mysqli_real_escape_string($koneksi, $movie_name);
    $movie_link = mysqli_real_escape_string($koneksi, $movie_link);
    $deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);

    $query = "INSERT INTO tbl_movie
                (genre_id, movie_name, movie_link, deskripsi)
              VALUES
                ($genre_id, '$movie_name', '$movie_link', '$deskripsi')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function getGenre(){
    global $koneksi;

    $query = "SELECT * FROM tbl_genre ORDER BY genre_name ASC";
    $result = mysqli_query($koneksi, $query);

    $data = [];

    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }

    return $data;
}


function getMoviesByGenre($genre)
{
    global $koneksi;

    $genre = mysqli_real_escape_string($koneksi, $genre);

    $query = "SELECT
                tbl_movie.id,
                tbl_movie.movie_name,
                tbl_movie.movie_link,
                tbl_movie.deskripsi,
                tbl_genre.genre_name
            FROM tbl_movie
            INNER JOIN tbl_genre
                ON tbl_movie.genre_id = tbl_genre.id
            WHERE tbl_genre.genre_name = '$genre'
            ORDER BY tbl_movie.id DESC";

    $result = mysqli_query($koneksi, $query);

    $data = [];

    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }

    return $data;
}




function updateWatched($movie_id, $watched)
{
    global $koneksi;

    $movie_id = (int)$movie_id;
    $watched = $watched ? 1 : 0;

    $query = "UPDATE tbl_movie
              SET watched = $watched
              WHERE id = $movie_id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}