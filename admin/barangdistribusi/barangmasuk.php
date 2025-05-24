<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Barang Distribusi</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Data Barang</li>
								</ol>
							</nav>
						</div>
						<div class="ml-auto">
							<div class="btn-group">
								
							</div>
						</div>
					</div>
					<!--end breadcrumb-->
					<div class="card radius-15">
						<div class="card-body">
							<div class="card-title">
								<h4 class="mb-0">Barang Masuk</h4>
							</div>
							<hr/>
<!-- Input Pencarian -->
<input type="text" id="" class="form-control mb-3" placeholder="Cari data..." onkeyup="searchTable()">
<div class="btn-group">
	<a href="?halaman=tambahbarang" class="btn btn-sm btn-primary">+ Tambah Barang</a>
</div>
<!-- Tabel Data -->
<div class="card radius-15">
						<div class="card-body">
							<hr/>
							<div class="table-responsive">
								<table class="table mb-0">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Nama Barang</th>
											<th scope="col">Tanggal Masuk</th>
											<th scope="col">Jumlah</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row">1</th>
											<td>Beras</td>
											<td>14-02-25</td>
											<td>10 Karung</td>
										</tr>
										<tr>
											<th scope="row">2</th>
											<td>Mi Instan</td>
											<td>16-02-25</td>
											<td>10 dus</td>
										</tr>
										<tr>
											<th scope="row">3</th>
											<td>Air Mineral 600ml</td>
											<td>09-03-25</td>
											<td>10 dus</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

<!-- Script Pencarian -->
<script>
    function searchTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let table = document.getElementById("example2");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) { 
            let cells = rows[i].getElementsByTagName("td");
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? "" : "none";
        }
    }
</script>
