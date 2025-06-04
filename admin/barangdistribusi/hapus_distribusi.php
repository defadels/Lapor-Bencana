<?php
require_once '../../config/koneksi.php';

$id_distribusi = $_GET['id_distribusi'];

// Ambil data distribusi yang akan dihapus
$query_distribusi = mysqli_query($koneksi, "SELECT * FROM distribusi WHERE id_distribusi = '$id_distribusi'") or die(mysqli_error($koneksi));
$data_distribusi = mysqli_fetch_assoc($query_distribusi);

if ($data_distribusi) {
    $id_barang = $data_distribusi['id_barang'];
    $jumlah = $data_distribusi['jumlah'];

    // Hapus data distribusi
    $query_hapus = mysqli_query($koneksi, "DELETE FROM distribusi WHERE id_distribusi = '$id_distribusi'") or die(mysqli_error($koneksi));

    if ($query_hapus) {
        // Kembalikan stok barang
        mysqli_query($koneksi, "UPDATE barang SET stok_gudang = stok_gudang + '$jumlah' WHERE id_barang = '$id_barang'") or die(mysqli_error($koneksi));
        echo "<script>alert('Data distribusi berhasil dihapus dan stok dikembalikan!'); window.location='?halaman=distribusi';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data distribusi.'); window.location='?halaman=distribusi';</script>";
    }
} else {
    echo "<script>alert('Data distribusi tidak ditemukan.'); window.location='?halaman=distribusi';</script>";
}
?> 