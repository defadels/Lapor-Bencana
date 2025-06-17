<?php
require_once '../../config/koneksi.php';

$id_distribusi = $_GET['id_distribusi'];

// Ambil data distribusi yang akan diedit
$query_data_distribusi = mysqli_query($koneksi, "SELECT * FROM distribusi WHERE id_distribusi = '$id_distribusi'") or die(mysqli_error($koneksi));
$data_distribusi = mysqli_fetch_assoc($query_data_distribusi);

// Ambil data barang untuk dropdown
$query_barang = "SELECT * FROM barang ORDER BY nama_barang ASC";
$result_barang = mysqli_query($koneksi, $query_barang);

if (isset($_POST['submit'])) {
    $id_barang_new = $_POST['id_barang'];
    $alamat_distribusi_new = $_POST['alamat_distribusi'];
    $jumlah_new = $_POST['jumlah'];
    $tanggal_distribusi_new = $_POST['tanggal_distribusi'];

    // Ambil data distribusi lama untuk mendapatkan jumlah lama dan id_barang lama
    $query_old_distribusi = mysqli_query($koneksi, "SELECT id_barang, jumlah FROM distribusi WHERE id_distribusi = '$id_distribusi'");
    $old_distribusi = mysqli_fetch_assoc($query_old_distribusi);
    $id_barang_old = $old_distribusi['id_barang'];
    $jumlah_old = $old_distribusi['jumlah'];

    // Cek stok tersedia jika id_barang berubah atau jumlah_new lebih besar dari jumlah_old
    if ($id_barang_new != $id_barang_old) {
        // Jika barang yang didistribusikan berubah, kembalikan stok barang lama dan cek stok barang baru
        mysqli_query($koneksi, "UPDATE barang SET stok_gudang = stok_gudang + '$jumlah_old' WHERE id_barang = '$id_barang_old'");

        $query_stok_new = "SELECT stok_gudang FROM barang WHERE id_barang = '$id_barang_new'";
        $result_stok_new = mysqli_query($koneksi, $query_stok_new);
        $data_stok_new = mysqli_fetch_assoc($result_stok_new);

        if ($data_stok_new['stok_gudang'] < $jumlah_new) {
            // Jika stok barang baru tidak cukup, kembalikan stok barang lama (yang sudah dikembalikan tadi)
            mysqli_query($koneksi, "UPDATE barang SET stok_gudang = stok_gudang - '$jumlah_old' WHERE id_barang = '$id_barang_old'");
            echo "<script>alert('Stok barang baru tidak mencukupi!'); window.location='edit_distribusi.php?id_distribusi=".$id_distribusi."';</script>";
            return;
        }

    } else { // Jika id_barang tidak berubah
        $query_stok_current = "SELECT stok_gudang FROM barang WHERE id_barang = '$id_barang_new'";
        $result_stok_current = mysqli_query($koneksi, $query_stok_current);
        $data_stok_current = mysqli_fetch_assoc($result_stok_current);

        $selisih_jumlah = $jumlah_new - $jumlah_old;

        if ($selisih_jumlah > 0) { // Jika jumlah bertambah, cek stok
            if ($data_stok_current['stok_gudang'] < $selisih_jumlah) {
                echo "<script>alert('Stok tidak mencukupi untuk penambahan jumlah! Stok tersedia: " . $data_stok_current['stok_gudang'] . "'); window.location='edit_distribusi.php?id_distribusi=".$id_distribusi."';</script>";
                return;
            }
        }
    }

    // Update data distribusi
    $query_update = "UPDATE distribusi SET 
                    id_barang = '$id_barang_new',
                    alamat_distribusi = '$alamat_distribusi_new',
                    jumlah = '$jumlah_new',
                    tanggal_distribusi = '$tanggal_distribusi_new'
                    WHERE id_distribusi = '$id_distribusi'";
    
    if (mysqli_query($koneksi, $query_update)) {
        // Sesuaikan stok di tabel barang (jika tidak di-handle oleh trigger, karena trigger hanya insert)
        // Jika trigger sudah ada, logik di bawah bisa dihilangkan
        
        // Jika id_barang berubah, stok barang baru dikurangi
        if ($id_barang_new != $id_barang_old) {
            mysqli_query($koneksi, "UPDATE barang SET stok_gudang = stok_gudang - '$jumlah_new' WHERE id_barang = '$id_barang_new'");
        } else { // Jika id_barang tidak berubah, sesuaikan stok berdasarkan selisih
            $selisih_jumlah = $jumlah_new - $jumlah_old;
            mysqli_query($koneksi, "UPDATE barang SET stok_gudang = stok_gudang - '$selisih_jumlah' WHERE id_barang = '$id_barang_new'");
        }

        echo "<script>alert('Data distribusi berhasil diupdate dan stok disesuaikan!'); window.location='?halaman=distribusi';</script>";
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
                <li class="breadcrumb-item active" aria-current="page">Edit Distribusi</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Edit Distribusi Barang</h4>
        </div>
        <hr/>
        <form method="POST">
            <div class="form-group">
                <label>Pilih Barang</label>
                <select class="form-control" name="id_barang" required>
                    <?php while($barang = mysqli_fetch_assoc($result_barang)): ?>
                        <option value="<?= $barang['id_barang'] ?>" <?= ($barang['id_barang'] == $data_distribusi['id_barang']) ? 'selected' : '' ?>>
                            <?= $barang['nama_barang'] ?> (Stok: <?= $barang['stok_gudang'] ?> <?= $barang['satuan'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat Distribusi</label>
                <textarea class="form-control" name="alamat_distribusi" required><?= $data_distribusi['alamat_distribusi'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" value="<?= $data_distribusi['jumlah'] ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal Distribusi</label>
                <input type="date" class="form-control" name="tanggal_distribusi" value="<?= $data_distribusi['tanggal_distribusi'] ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
            <a href="?halaman=distribusi" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div> 