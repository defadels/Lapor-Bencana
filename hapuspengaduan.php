<?php

$id = $_GET['id_pengaduan'];

$query_show = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id'") or die(mysqli_error());

$data_lama = $query_show->fetch_assoc();
unlink("foto/".$data_lama['foto']);

$query_hapus = mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan= '$id'") or die(mysqli_error($koneksi));

if($query_hapus){
    echo "<script> alert('Berhasil hapus data'); </script>";
    echo "<script> document.location.href='index.php'; </script>";
} else {
    echo "<script> alert('Gagal hapus data'); </script>";
    echo "<script> document.location.href='index.php'; </script>";
}

?>