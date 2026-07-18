# Blueprint Pola PHP (forum_pendaftaran)

Catatan ini dibuat supaya kamu bisa meniru **pola penulisan** PHP dari project `forum_pendaftaran` ke project lain. Isinya merangkum alur auth, registrasi, role-based access, dan gaya controller–fungsi.

> Fokus: pola yang sudah dipakai di repo, bukan rekomendasi arsitektur baru.

---

## 1) Struktur file yang dipakai

### `koneksi.php`
Membuat koneksi MySQLi.
- biasakan: `require "koneksi.php"` di tempat yang butuh koneksi.

### `fungsi.php`
Berisi fungsi-fungsi utama:
- `buatAkun($data)`
- `login($akun)`
- `cekRegistrasi($username)`
- `registrasi($datareg)`
- `tampilPendaftar($pendaftar)`
- `editRegistrasi($dtedit)`
- `hapusPendaftaran($username)`

Umumnya:
- setiap fungsi memakai `global $koneksi;`
- query dibuat dengan MySQLi.

### Halaman web (contoh `login.php`, `buat_akun.php`, `pelamar/*.php`, `panitia/index.php`)
Fungsinya sebagai **controller**:
- `session_start();`
- `require "fungsi.php";` (atau `../fungsi.php` jika dalam subfolder)
- validasi role
- proses `$_POST` atau `$_GET`
- memanggil fungsi di `fungsi.php`
- hasil sukses/gagal ditangani pakai `alert + document.location.href`

---

## 2) Pola session & role-based access

### Role yang dipakai
- `$_SESSION['peran'] = 'pelamar'`
- `$_SESSION['peran'] = 'panitia'`

### Pola pengecekan di awal halaman khusus role
Contoh pola yang sama di beberapa halaman:

```php
session_start();
require "../fungsi.php"; // atau require "fungsi.php" sesuai lokasi

if(!isset($_SESSION['is_logged_in'])){
    header("Location: ../login.php");
    exit;
}

if($_SESSION['peran'] != 'pelamar'){
    header("Location: ../login.php");
    exit;
}
```

Untuk halaman panitia:
- ganti pemeriksaan `$_SESSION['peran'] !== 'panitia'`.

### Redirect login
- `login.php` setelah sukses:
  - set `$_SESSION['username']`
  - set `$_SESSION['is_logged_in'] = true`
  - set `$_SESSION['peran'] = 'pelamar'|'panitia'`
  - redirect ke folder role masing-masing.

---

## 3) Pola “Auth” (akun + login)

### 3.1 `buat_akun.php` → memanggil `fungsi.php: buatAkun()`
- halaman form ambil `$_POST` (`username`, `email`, `password`, dst)
- lalu:

```php
require "fungsi.php";

if(isset($_POST['buatakun'])){
    if(buatAkun($_POST) > 0){
        // alert berhasil
        // redirect ke login.php
    }
}
```

### 3.2 `fungsi.php: buatAkun($data)`
- input diambil dari `$data['username']`, `$data['password']`, `$data['email']`
- `password_hash($password, PASSWORD_DEFAULT)`
- cek username sudah ada atau belum
- kalau sukses: INSERT ke `tbl_user`
- return:
  - `1` sukses
  - `-1` username sudah terdaftar

### 3.3 `login.php` → memanggil `fungsi.php: login()`
- controller melakukan:

```php
require "fungsi.php";

if(isset($_POST['login'])){
    $res = login($_POST);

    if($res == 1){
        // pelamar
    } else if($res == 2){
        // panitia
    } else if($res == -1){
        // username tidak ditemukan
    } else {
        // password salah
    }
}
```

### 3.4 `fungsi.php: login($akun)` (logika return)
- cek user di `tbl_user` berdasarkan username
- `password_verify($password_input, $hash_db)`
- return berdasarkan kondisi:
  - `1` = username+password benar + peran pelamar
  - `2` = username+password benar + peran panitia
  - `0` = username benar, password salah
  - `-1` = username tidak ditemukan

---

## 4) Pola Registrasi Pelamar (buat/isi/edit/hapus)

### 4.1 cek apakah sudah registrasi: `cekRegistrasi($username)`
- dipakai di `pelamar/registrasi.php`:

```php
if(cekRegistrasi($username) == 0){
   // tampilkan form input
} else {
   // tampilkan data & link edit/hapus
}
```

### 4.2 insert registrasi: `fungsi.php: registrasi($datareg)`
- controller `pelamar/registrasi.php` memanggil ketika tombol submit terdeteksi:

```php
$hasil = registrasi($_POST);

if($hasil > 0){
  // alert sukses + redirect
} else {
  // alert gagal
}
```

- di `fungsi.php`, `registrasi()`:
  - baca `$_SESSION['username']`
  - sanitize semua field dari `$datareg[...]`
  - INSERT ke `tbl_registrasi`
  - ambil `idRegis` dari tabel untuk INSERT ke `tbl_orangtua`

### 4.3 tampil data registrasi: `tampilPendaftar($username)`
- controller memakai:

```php
$dataPendaftar = tampilPendaftar($username);
foreach($dataPendaftar as $pendaftar){
   // tampilkan field
}
```

- `tampilPendaftar()` mengembalikan array hasil `SELECT ... INNER JOIN`.

### 4.4 update registrasi: `editRegistrasi($dtedit)`
Dipakai di `pelamar/editregistrasi.php`:
- saat render form: prefill menggunakan hasil `tampilPendaftar($username)`
- saat submit: controller memanggil `editRegistrasi($_POST)`

pola:

```php
if(isset($_POST['editregistrasi'])){
    if(editRegistrasi($_POST) == 1){
        // alert sukses + redirect
    } else {
        // alert gagal
    }
}
```

### 4.5 hapus/batal pendaftaran: `hapusPendaftaran($username)`
- controller memanggil dari query string:

```php
if(isset($_GET['username'])){
    if(hapusPendaftaran($_GET['username'])){
        // alert sukses
    } else {
        // alert gagal
    }
}
```

- `hapusPendaftaran()` di `fungsi.php` melakukan `DELETE FROM tbl_registrasi WHERE username = '$username'`.

---

## 5) Template “controller” siap tiru

### 5.1 Template halaman role (pelamar/panitia)

```php
<?php
session_start();
require "../fungsi.php"; // sesuaikan path

if(!isset($_SESSION['is_logged_in'])){
    header("Location: ../login.php");
    exit;
}

if($_SESSION['peran'] !== 'pelamar'){ // atau 'panitia'
    header("Location: ../login.php");
    exit;
}

// Lanjutkan logic view + submit
?>
```

### 5.2 Template submit form (POST)

```php
<?php
require "../fungsi.php";

if(isset($_POST['namaTombol'])){
    $hasil = namaFungsiDiFungsiPhp($_POST);

    if($hasil > 0){
        echo "<script>
            alert('Sukses');
            document.location.href='target.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal');
        </script>";
    }
}
?>
```

### 5.3 Template delete via GET

```php
<?php
require "../fungsi.php";

if(isset($_GET['username'])){
    if(hapusPendaftaran($_GET['username'])){
        echo "<script>
            alert('Berhasil');
            document.location.href='registrasi.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal');
            document.location.href='registrasi.php';
        </script>";
    }
}
?>
```

---

## 6) Cara kamu “menerapkan ke project lain”

Saat bikin project baru, lakukan:
1. **Buat `koneksi.php`** mirip ini.
2. **Buat `fungsi.php`** yang isinya fungsi-fungsi CRUD & auth.
3. **Buat halaman controller**:
   - mulai session
   - require fungsi
   - validasi role
   - proses `$_POST`/`$_GET`
   - panggil fungsi dari `fungsi.php`
   - redirect/alert

---

## 7) Catatan penting dari style repo ini
- Input disanitasi dengan `mysqli_real_escape_string($koneksi, ...)`.
- Password memakai `password_hash` dan login memakai `password_verify`.
- Handle sukses/gagal memakai return integer (mis. `>0`, `==1`, `==0`, `-1`, dll).

---

## Ringkas (1 kalimat)
Repo ini memakai pola: **`fungsi.php` berisi query+logika, sedangkan halaman PHP berisi session/role + UI + panggilan fungsi + redirect**.

