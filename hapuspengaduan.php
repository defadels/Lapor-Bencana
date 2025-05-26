<?php

$id = $_GET['id_pengaduan'];

$query_show = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id'") or die(mysqli_error());

$data_lama = $query_show->fetch_assoc();

// Hapus file foto jika ada
if($data_lama['foto']) {
    unlink("foto/".$data_lama['foto']);
}

// Hapus file video jika ada
if($data_lama['video']) {
    unlink("video/".$data_lama['video']);
}

$query_hapus = mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan= '$id'") or die(mysqli_error($koneksi));

if($query_hapus){
    echo "<script> alert('Berhasil hapus data'); </script>";
    echo "<script> document.location.href='index.php'; </script>";
} else {
    echo "<script> alert('Gagal hapus data'); </script>";
    echo "<script> document.location.href='index.php'; </script>";
}

?>