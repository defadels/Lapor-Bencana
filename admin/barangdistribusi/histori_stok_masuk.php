<?php
require_once '../../config/koneksi.php';

// Query untuk mengambil data stok masuk
$query = "SELECT sm.*, b.nama_barang, b.satuan
          FROM stok_masuk sm
          JOIN barang b ON sm.id_barang = b.id_barang
          ORDER BY sm.tanggal_masuk DESC";
$result = mysqli_query($koneksi, $query);
?>

<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3">Barang Distribusi</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Histori Stok Masuk</li>
            </ol>
        </nav>
    </div>
    <div class="ml-auto">
        <div class="btn-group">
            <a href="?halaman=tambahstok" class="btn btn-primary">Tambah Stok Baru</a>
        </div>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Data Histori Stok Masuk</h4>
        </div>
        <hr/>
        <!-- Input Pencarian -->
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari data..." onkeyup="searchTable()">
        
        <div class="table-responsive">
            <table class="table mb-0" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)): 
                    ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= date('d-m-Y', strtotime($row['tanggal_masuk'])) ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= $row['satuan'] ?></td>
                        <td>
                            <a href="?halaman=editstokmasuk&id_stok_masuk=<?= $row['id_stok_masuk'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?halaman=hapusstokmasuk&id_stok_masuk=<?= $row['id_stok_masuk'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}
</script> 