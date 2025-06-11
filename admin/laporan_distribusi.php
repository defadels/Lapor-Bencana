<?php

// Query untuk mengambil data distribusi
$query = "SELECT d.*, b.nama_barang, b.satuan
          FROM distribusi d
          JOIN barang b ON d.id_barang = b.id_barang
          ORDER BY d.tanggal_distribusi DESC";
$result = mysqli_query($koneksi, $query);
?>

<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Laporan</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Data Laporan Distribusi</li>
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
								<h4 class="mb-0">Data Laporan Distribusi</h4>
							</div>
							<hr/>
							<div class="table-responsive">
								<table class="table mb-0" id="example2">
									<thead>
										<tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Alamat Distribusi</th>
										</tr>
									</thead>
									<tbody>
                                    <?php 
                                        $no = 1;
                                        while($row = mysqli_fetch_assoc($result)): 
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= date('d-m-Y', strtotime($row['tanggal_distribusi'])) ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['jumlah'] ?></td>
                                            <td><?= $row['satuan'] ?></td>
                                            <td><?= $row['alamat_distribusi'] ?></td>
                                            <!-- <td>
                                                <a href="?halaman=editdistribusi&id_distribusi=<?= $row['id_distribusi'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="?halaman=hapusdistribusi&id_distribusi=<?= $row['id_distribusi'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                            </td> -->
                                        </tr>
                                        <?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>