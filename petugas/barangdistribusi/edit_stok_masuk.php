<?php
require_once '../../config/koneksi.php';

$id_stok_masuk = $_GET['id_stok_masuk'];

// Ambil data stok masuk yang akan diedit
$query_data_stok_masuk = mysqli_query($koneksi, "SELECT * FROM stok_masuk WHERE id_stok_masuk = '$id_stok_masuk'") or die(mysqli_error($koneksi));
$data_stok_masuk = mysqli_fetch_assoc($query_data_stok_masuk);

// Ambil data barang untuk dropdown
$query_barang = "SELECT * FROM barang ORDER BY nama_barang ASC";
$result_barang = mysqli_query($koneksi, $query_barang);

if (isset($_POST['submit'])) {
    $id_barang_new = $_POST['id_barang'];
    $jumlah_new = $_POST['jumlah'];
    $tanggal_masuk_new = $_POST['tanggal_masuk'];

    // Ambil data stok masuk lama untuk mendapatkan jumlah lama dan id_barang lama
    $query_old_stok_masuk = mysqli_query($koneksi, "SELECT id_barang, jumlah FROM stok_masuk WHERE id_stok_masuk = '$id_stok_masuk'");
    $old_stok_masuk = mysqli_fetch_assoc($query_old_stok_masuk);
    $id_barang_old = $old_stok_masuk['id_barang'];
    $jumlah_old = $old_stok_masuk['jumlah'];

    // Sesuaikan stok di tabel barang
    // Jika id_barang berubah, kembalikan stok barang lama dan tambahkan stok barang baru
    if ($id_barang_new != $id_barang_old) {
        // Kurangi stok lama
        mysqli_query($koneksi, "UPDATE barang SET stok_gudang = stok_gudang - '$jumlah_old' WHERE id_barang = '$id_barang_old'") or die(mysqli_error($koneksi));
        // Tambahkan stok baru
        mysqli_query($koneksi, "UPDATE barang SET stok_gudang = stok_gudang + '$jumlah_new' WHERE id_barang = '$id_barang_new'") or die(mysqli_error($koneksi));
    } else { 
        // Jika id_barang tidak berubah, sesuaikan stok berdasarkan selisih jumlah
        $selisih_jumlah = $jumlah_new - $jumlah_old;
        mysqli_query($koneksi, "UPDATE barang SET stok_gudang = stok_gudang + '$selisih_jumlah' WHERE id_barang = '$id_barang_new'") or die(mysqli_error($koneksi));
    }

    // Update data stok masuk
    $query_update = "UPDATE stok_masuk SET 
                    id_barang = '$id_barang_new',
                    jumlah = '$jumlah_new',
                    tanggal_masuk = '$tanggal_masuk_new'
                    WHERE id_stok_masuk = '$id_stok_masuk'";
    
    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>alert('Data stok masuk berhasil diupdate dan stok disesuaikan!'); window.location='?halaman=historistokmasuk';</script>";
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
                <li class="breadcrumb-item active" aria-current="page">Edit Stok Masuk</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Edit Stok Masuk Barang</h4>
        </div>
        <hr/>
        <form method="POST">
            <div class="form-group">
                <label>Pilih Barang</label>
                <select class="form-control" name="id_barang" required>
                    <?php while($barang = mysqli_fetch_assoc($result_barang)): ?>
                        <option value="<?= $barang['id_barang'] ?>" <?= ($barang['id_barang'] == $data_stok_masuk['id_barang']) ? 'selected' : '' ?>>
                            <?= $barang['nama_barang'] ?> (Stok: <?= $barang['stok_gudang'] ?> <?= $barang['satuan'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" value="<?= $data_stok_masuk['jumlah'] ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" class="form-control" name="tanggal_masuk" value="<?= $data_stok_masuk['tanggal_masuk'] ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
            <a href="?halaman=historistokmasuk" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div> 