<?php
require_once '../../config/koneksi.php';

$id_stok_masuk = $_GET['id_stok_masuk'];

// Ambil data stok masuk yang akan dihapus
$query_stok_masuk = mysqli_query($koneksi, "SELECT * FROM stok_masuk WHERE id_stok_masuk = '$id_stok_masuk'") or die(mysqli_error($koneksi));
$data_stok_masuk = mysqli_fetch_assoc($query_stok_masuk);

if ($data_stok_masuk) {
    $id_barang = $data_stok_masuk['id_barang'];
    $jumlah = $data_stok_masuk['jumlah'];

    // Hapus data stok masuk
    $query_hapus = mysqli_query($koneksi, "DELETE FROM stok_masuk WHERE id_stok_masuk = '$id_stok_masuk'") or die(mysqli_error($koneksi));

    if ($query_hapus) {
        // Kurangi stok barang di tabel barang
        mysqli_query($koneksi, "UPDATE barang SET stok_gudang = stok_gudang - '$jumlah' WHERE id_barang = '$id_barang'") or die(mysqli_error($koneksi));
        echo "<script>alert('Data stok masuk berhasil dihapus dan stok disesuaikan!'); window.location='?halaman=historistokmasuk';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data stok masuk.'); window.location='?halaman=historistokmasuk';</script>";
    }
} else {
    echo "<script>alert('Data stok masuk tidak ditemukan.'); window.location='?halaman=historistokmasuk';</script>";
}
?> 