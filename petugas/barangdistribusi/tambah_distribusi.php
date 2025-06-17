<?php

if (isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $alamat_distribusi = $_POST['alamat_distribusi'];
    $jumlah = $_POST['jumlah'];
    $tanggal_distribusi = $_POST['tanggal_distribusi'];
    
    // Cek stok tersedia
    $query_stok = "SELECT stok_gudang FROM barang WHERE id_barang = '$id_barang'";
    $result_stok = mysqli_query($koneksi, $query_stok);
    $data_stok = mysqli_fetch_assoc($result_stok);
    
    if ($data_stok['stok_gudang'] >= $jumlah) {
        // Insert ke tabel distribusi
        $query = "INSERT INTO distribusi (id_barang, alamat_distribusi, jumlah, tanggal_distribusi) 
                 VALUES ('$id_barang', '$alamat_distribusi', '$jumlah', '$tanggal_distribusi')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Distribusi barang berhasil dicatat!'); window.location='?halaman=distribusi';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
        }
    } else {
        echo "<script>alert('Stok tidak mencukupi! Stok tersedia: " . $data_stok['stok_gudang'] . "');</script>";
    }
}

// Ambil data barang untuk dropdown
$query_barang = "SELECT * FROM barang WHERE stok_gudang > 0 ORDER BY nama_barang ASC";
$result_barang = mysqli_query($koneksi, $query_barang);
?>

<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3">Barang Distribusi</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Distribusi</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Tambah Distribusi Barang</h4>
        </div>
        <hr/>
        <form method="POST">
            <div class="form-group">
                <label>Pilih Barang</label>
                <select class="form-control" name="id_barang" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php while($barang = mysqli_fetch_assoc($result_barang)): ?>
                        <option value="<?= $barang['id_barang'] ?>"><?= $barang['nama_barang'] ?> (Stok: <?= $barang['stok_gudang'] ?> <?= $barang['satuan'] ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat Distribusi</label>
                <textarea class="form-control" name="alamat_distribusi" required></textarea>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required>
            </div>
            <div class="form-group">
                <label>Tanggal Distribusi</label>
                <input type="date" class="form-control" name="tanggal_distribusi" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="?halaman=distribusi" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div> 