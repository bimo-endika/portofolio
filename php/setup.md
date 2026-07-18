# Setup Pola PHP

## Struktur File
- **`koneksi.php`**: pembuatan koneksi MySQLi.  
  * biasakan `require "koneksi.php"` di tempat yang butuh koneksi. *

- **`fungsi.php`**: fungsi-fungsi utama:  
  `buatAkun($data)`, `login($akun)`, `cekRegistrasi($username)`, `registrasi($datareg)`, `tampilPendaftar($pendaftar)`, `editRegistrasi($dtedit)`, `hapusPendaftaran($username)`.

- **Halaman web** (contoh: `login.php`, `buat_akun.php`, `pelamar/*.php`, `panitia/index.php`): controller yang  
  - `session_start();`  
  - `require "fungsi.php"` (atau path yang tepat)  
  - validasi role  
  - proses `$_POST` atau `$_GET`  
  - panggil fungsi di `fungsi.php`  
  - hasil sukses/gagal ditangani pakai `alert + document.location.href`.

## Auth & Role‑Based Access
- `$_SESSION['peran']` dapat bernilai `'pelamar'` atau `'panitia'`.
- Pengecekan role di awal halaman (contoh):
  ```php
  session_start();
  require "../fungsi.php";

  if (!isset($_SESSION['is_logged_in'])) {
      header("Location: ../login.php");
      exit;
  }
  if ($_SESSION['peran'] != 'pelamar') {
      header("Location: ../login.php");
      exit;
  }
  ```
- Untuk halaman panitia, ganti pemeriksaan menjadi `$_SESSION['peran'] !== 'panitia'`.

## Proses Auth
### Registrasi
1. `buat_akun.php` mengumpulkan `$_POST` (username, email, password, …) dan memanggil `fungsi.php: buatAkun($data)`.  
2. `buatAkun()`:
   - Ambil nilai dari `$data`.  
   - Hash password dengan `password_hash($password, PASSWORD_DEFAULT)`.  
   - Cek apakah username sudah ada.  
   - INSERT ke `tbl_user`.  
   - Kembalikan **`1`** untuk sukses, **-1** bila username sudah terdaftar.

### Login
1. `login.php` mengumpulkan `$_POST['login']` dan memanggil `fungsi.php: login($akun)`.  
2. `login()`:
   - Cek user di `tbl_user` berdasarkan username.  
   - Verifikasi password dengan `password_verify()`.  
   - Kembalikan **`1`** (berhasil + peran pelamar), **`2`** (berhasil + peran panitia), **`0`** (password salah), **-1** (username tidak ditemukan).

### Hasil Return di Controller
```php
$res = login($_POST);
if ($res == 1) { /* pelamar */ }
elseif ($res == 2) { /* panitia */ }
elseif ($res == -1) { /* username tidak ditemukan */ }
else { /* password salah */ }
```

## Registrasi Pelamar (CRUD)
- **Cek Registrasi**: `cekRegistrasi($username)` dipakai di `pelamar/registrasi.php`.  
- **Insert Registrasi**: `registrasi($datareg)` menjadi `INSERT` ke `tbl_registrasi`, kemudian INSERT ke `tbl_orangtua` menggunakan `idRegis`.  
- **Tampil Pendaftar**: `tampilPendaftar($username)` mengembalikan array hasil `SELECT … INNER JOIN`.  
- **Edit Registrasi**: `editRegistrasi($dtedit)` dipanggil dari `pelamar/editregistrasi.php`.  
- **Hapus Registrasi**: `hapusPendaftaran($username)` menghapus baris di `tbl_registrasi`.

## Redirect Login
Setelah berhasil:
```php
$_SESSION['username'] = $username;
$_SESSION['is_logged_in'] = true;
$_SESSION['peran'] = 'pelamar' | 'panitia';
redirect ke folder role masing-masing;
```

## Template Controller (siap pakai)
```php
<?php
session_start();
require "../fungsi.php"; // sesuaikan path

if (!isset($_SESSION['is_logged_in'])) {
    header("Location: ../login.php");
    exit;
}
if ($_SESSION['peran'] !== 'pelamar') { // atau 'panitia'
    header("Location: ../login.php");
    exit;
}

/* Lanjutkan logic view + submit */
?>
```

## Template Submit Form (POST)
```php
<?php
require "../fungsi.php";

if (isset($_POST['namaTombol'])) {
    $hasil = namaFungsiDiFungsiPhp($_POST);
    if ($hasil > 0) {
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

## Template Delete via GET
```php
<?php
require "../fungsi.php";

if (isset($_GET['username'])) {
    if (hapusPendaftaran($_GET['username'])) {
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

## Catatan Penting dari Style Repo
- **Sanitasi input** dengan `mysqli_real_escape_string($koneksi, ...)`.  
- **Password** digunakan `password_hash` saat pembuatan dan `password_verify` saat login.  
- **Handle sukses/gagal** memakai return integer (mis. `>0`, `==1`, `==0`, `-1`, dll.).  
- Semua file `*.php` diakhiri dengan `exit;` setelah redirect untuk mencegah eksekusi lanjutan.

---

Dokumentasi ini dapat di‑copy ke project baru dengan membuat:

1. `koneksi.php` yang menginisiasi MySQLi.  
2. `fungsi.php` berisi fungsi‑fungsi CRUD & auth seperti di atas.  
3. Halaman controller (login, pendaftaran, edit, dll.) yang mengikuti template session + role validation + panggilan fungsi.