<?php
include 'koneksi.php';

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// Cek validitas ID
if ($id <= 0) {
    echo "<script>alert('ID tidak valid.');window.location='index.php';</script>";
    exit;
}

// 1. Ambil data produk (untuk mengetahui nama file gambarnya)
$query_select = "SELECT gambar_produk FROM produk WHERE id = '$id'";
$result_select = mysqli_query($koneksi, $query_select);
$data = mysqli_fetch_assoc($result_select);

if ($data) {
    // 2. Jika gambar ada dan file-nya ada di folder, hapus
    $gambar = $data['gambar_produk'];
    if (!empty($gambar) && file_exists("gambar/" . $gambar)) {
        unlink("gambar/" . $gambar); // HAPUS FILE GAMBAR
    }

    // 3. Hapus data produk dari database
    $query_delete = "DELETE FROM produk WHERE id = '$id'";
    $result_delete = mysqli_query($koneksi, $query_delete);

    if (!$result_delete) {
        die("Gagal menghapus data: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('Produk tidak ditemukan.');window.location='index.php';</script>";
}
//check berhasil  atau engga 
if (unlink("gambar/" . $gambar)) {
  echo "Gambar berhasil dihapus.";
} else {
  echo "Gagal menghapus gambar.";
}

?>


