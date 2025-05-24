<?php

$id = $_GET['id_petugas'];

$query_hapus = mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas = '$id'") or die(mysqli_query($koneksi));

if($query_hapus){
    echo "<script> alert('Berhasil hapus data'); </script>";
    echo "<script> document.location.href='index.php?halaman=petugas'; </script>";
} else {
    echo "<script> alert('Gagal hapus data'); </script>";
    echo "<script> document.location.href='index.php?halaman=petugas'; </script>";
}

?>