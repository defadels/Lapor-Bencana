<?php

// Query untuk mengambil data stok barang
$query = "SELECT b.*, 
          COALESCE(SUM(sm.jumlah), 0) as total_masuk,
          COALESCE(SUM(d.jumlah), 0) as total_keluar
          FROM barang b
          LEFT JOIN stok_masuk sm ON b.id_barang = sm.id_barang
          LEFT JOIN distribusi d ON b.id_barang = d.id_barang
          GROUP BY b.id_barang
          ORDER BY b.nama_barang ASC";
$result = mysqli_query($koneksi, $query);
?>

<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3">Barang Distribusi</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Stok Barang</li>
            </ol>
        </nav>
    </div>
    <div class="ml-auto">
        <div class="btn-group">
            <a href="?halaman=tambahbarang" class="btn btn-primary">Tambah Barang</a>
            <a href="?halaman=tambahstok" class="btn btn-success ml-2">Tambah Stok</a>
            <!-- <a href="?halaman=historistokmasuk" class="btn btn-info ml-2">Histori Stok Masuk</a> -->
        </div>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Data Stok Barang</h4>
        </div>
        <hr/>
        <!-- Input Pencarian -->
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari data..." onkeyup="searchTable()">
        
        <div class="table-responsive">
            <table class="table mb-0" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Total Masuk</th>
                        <th scope="col">Total Keluar</th>
                        <th scope="col">Stok Tersedia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)): 
                    ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $row['nama_barang'] ?></td>
                        <td><?= $row['satuan'] ?></td>
                        <td><?= $row['total_masuk'] ?></td>
                        <td><?= $row['total_keluar'] ?></td>
                        <td><?= $row['stok_gudang'] ?></td>
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