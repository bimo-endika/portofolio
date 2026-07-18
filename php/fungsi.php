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







function setWatched($username, $movie_source, $movie_id, $ditonton){
    global $koneksi;

    $username = mysqli_real_escape_string($koneksi, $username);
    $movie_source = mysqli_real_escape_string($koneksi, $movie_source);
    $movie_id = (int)$movie_id;

    if ($ditonton == 1) {
        $cek = "SELECT id FROM tbl_mvWatched WHERE username='$username' AND movie_source='$movie_source' AND movie_id=$movie_id LIMIT 1";
        $hcek = mysqli_query($koneksi, $cek);
        if ($hcek && mysqli_num_rows($hcek) == 0) {
            $ins = "INSERT INTO tbl_mvWatched (username, movie_source, movie_id) VALUES ('$username', '$movie_source', $movie_id)";
            mysqli_query($koneksi, $ins);
        }
        return 1;
    }

    // ditonton = 0 -> hapus
    $del = "DELETE FROM tbl_mvWatched WHERE username='$username' AND movie_source='$movie_source' AND movie_id=$movie_id";
    mysqli_query($koneksi, $del);
    return 1;
}
?>
