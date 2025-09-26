<?php
include 'koneksi.php';

// Ambil data dari form
$nama_produk   = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
$deskripsi     = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$harga_beli    = mysqli_real_escape_string($koneksi, $_POST['harga_beli']);
$harga_jual    = mysqli_real_escape_string($koneksi, $_POST['harga_jual']);
$gambar_produk = $_FILES['gambar_produk']['name'];

// Validasi input sederhana
if (empty($nama_produk) || empty($harga_beli) || empty($harga_jual)) {
    echo "<script>alert('Nama produk dan harga tidak boleh kosong.');window.location='tambah_produk.php';</script>";
    exit;
}

if ($gambar_produk != "") {
    $ekstensi_diperbolehkan = ['png','jpg','jpeg','webp'];
    $x = explode('.', $gambar_produk);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_produk']['tmp_name'];
    $file_size = $_FILES['gambar_produk']['size'];

    $angka_acak = rand(1,999);
    $nama_gambar_baru = $angka_acak . '-' . $gambar_produk;

    // Validasi ekstensi & ukuran
    if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {
        echo "<script>alert('Ekstensi gambar hanya boleh jpg, jpeg, png, atau webp.');window.location='tambah_produk.php';</script>";
        exit;
    }

    if ($file_size > 2097152) { // 2MB
        echo "<script>alert('Ukuran gambar maksimal 2MB.');window.location='tambah_produk.php';</script>";
        exit;
    }

    // Upload file
    move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru);

    // Simpan ke DB
    $query = "INSERT INTO produk (nama_produk, deskripsi, harga_beli, harga_jual, gambar_produk)
              VALUES ('$nama_produk', '$deskripsi', '$harga_beli', '$harga_jual', '$nama_gambar_baru')";
} else {
    // Tanpa gambar
    $query = "INSERT INTO produk (nama_produk, deskripsi, harga_beli, harga_jual, gambar_produk)
              VALUES ('$nama_produk', '$deskripsi', '$harga_beli', '$harga_jual', NULL)";
}

$result = mysqli_query($koneksi, $query);

// Cek hasil query
if (!$result) {
    die("Query gagal: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
}
?>
