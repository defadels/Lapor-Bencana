<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Laporan</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Data Laporan</li>
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
								<h4 class="mb-0">Data Laporan</h4>
							</div>
							<hr/>
							<div class="table-responsive">
								<table class="table mb-0" id="example2">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Tanggal Pengaduan</th>
											<th scope="col">NIK</th>
											<th scope="col">Nama Pengirim</th>
											<th scope="col">Nomor Telepon</th>
                                            <th scope="col">Kecamatan</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Jenis Bencana</th>
                                            <th scope="col">Penyebab Bencana</th>
                                            <th scope="col">Dampak Kerugian</th>
                                            <th scope="col">Kebutuhan</th>
                                            <th scope="col">Status</th>
										</tr>
									</thead>
									<tbody>

										<?php

										$laporan = mysqli_query($koneksi, "SELECT * FROM pengaduan JOIN masyarakat ON pengaduan.nik=masyarakat.nik ORDER BY tgl_pengaduan DESC") or die(mysqli_error());

										$no = 1;

										while($data_laporan = $laporan->fetch_assoc()) {


										?>
										<tr>
											<th scope="row"><?php echo $no++; ?></th>
											<td><?php echo $data_laporan['tgl_pengaduan']; ?></td>
                                            <td><?php echo $data_laporan['nik']; ?></td>
                                            <td><?php echo $data_laporan['nama']; ?></td>
                                            <td><?php echo $data_laporan['telp']; ?></td>
                                            <td><?php echo $data_laporan['kecamatan']; ?></td>
                                            <td><?php echo $data_laporan['alamat']; ?></td>
                                            <td><?php echo $data_laporan['jenis_bencana']; ?></td>
                                            <td><?php echo $data_laporan['penyebab']; ?></td>
                                            <td><?php echo $data_laporan['dampak_kerugian']; ?></td>
                                            <td><?php echo $data_laporan['kebutuhan']; ?></td>
                                            <td><?php echo strtoupper($data_laporan['status']); ?></td>
										</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>