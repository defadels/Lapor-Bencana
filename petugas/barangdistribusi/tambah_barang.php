<?php

if (isset($_POST['submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $satuan = $_POST['satuan'];
    
    $query = "INSERT INTO barang (nama_barang, satuan) VALUES ('$nama_barang', '$satuan')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data barang berhasil ditambahkan!'); window.location='?halaman=stokbarang';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3">Barang Distribusi</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Tambah Barang Baru</h4>
        </div>
        <hr/>
        <form method="POST">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" class="form-control" name="satuan" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="?halaman=stokbarang" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div> 