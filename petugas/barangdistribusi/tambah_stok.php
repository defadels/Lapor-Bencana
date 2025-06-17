<?php

if (isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    
    // Insert ke tabel stok_masuk
    $query = "INSERT INTO stok_masuk (id_barang, jumlah, tanggal_masuk) VALUES ('$id_barang', '$jumlah', '$tanggal_masuk')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Stok barang berhasil ditambahkan!'); window.location='index.php?halaman=stokbarang';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}

// Ambil data barang untuk dropdown
$query_barang = "SELECT * FROM barang ORDER BY nama_barang ASC";
$result_barang = mysqli_query($koneksi, $query_barang);
?>

<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3">Barang Distribusi</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Stok</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Tambah Stok Barang</h4>
        </div>
        <hr/>
        <form method="POST">
            <div class="form-group">
                <label>Pilih Barang</label>
                <select class="form-control" name="id_barang" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php while($barang = mysqli_fetch_assoc($result_barang)): ?>
                        <option value="<?= $barang['id_barang'] ?>"><?= $barang['nama_barang'] ?> (<?= $barang['satuan'] ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required>
            </div>
            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" class="form-control" name="tanggal_masuk" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="stok_barang.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div> 