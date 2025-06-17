<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Pengaduan</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Data Pengaduan Proses</li>
								</ol>
							</nav>
						</div>
						<div class="ml-auto">
							
						</div>
					</div>
					<!--end breadcrumb-->
					<div class="card radius-15">
						<div class="card-body">
							<div class="card-title">
								<h4 class="mb-0">Data Pengaduan Proses</h4>
							</div>
							<hr/>
							<div class="table-responsive">
								<table class="table mb-0">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Tanggal</th>
											<th scope="col">Nama Pengirim</th>
											<th scope="col">Foto</th>
											<th scope="col">Aksi</th>
										</tr>
									</thead>
									<tbody>

										<?php

										$pengaduan = mysqli_query($koneksi, "SELECT * FROM pengaduan JOIN masyarakat ON pengaduan.nik=masyarakat.nik WHERE status='proses' ORDER BY tgl_pengaduan DESC") or die(mysqli_error());

										$no = 1;

										while($data_pengaduan = $pengaduan->fetch_assoc()) {


										?>
										<tr>
											<th scope="row"><?php echo $no++; ?></th>
											<td><?php echo $data_pengaduan['tgl_pengaduan'];  ?></td>
											<td><?php echo $data_pengaduan['nama'];  ?></td>
                                            <td>
                                                <img src="../foto/<?php echo $data_pengaduan['foto'];  ?>" style="width: 50%" alt="" class="img-fluid">
                                            </td>
											<td>

							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tanggapanPetugas<?php echo $data_pengaduan['id_pengaduan']; ?>">
							Beri Tanggapan
							</button>

											<!-- Modal -->
							<div class="modal fade" id="tanggapanPetugas<?php echo $data_pengaduan['id_pengaduan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">
										Tanggapi Laporan?</h5>
									
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									
									<form action="" method="post">
									<input type="hidden" name="id_pengaduan" value="<?php echo $data_pengaduan['id_pengaduan'];  ?>">		
									<input type="hidden" name="id_petugas" value="<?php echo $_SESSION['admin']['id_petugas']; ?>">

								<div class="form-group">
											<label for="">NIK</label>
											<input type="text" readonly  class="form-control"  value="<?php echo $data_pengaduan['nik'];  ?>">
										</div>
										<div class="form-group">
											<label for="">Nama</label>
											<input type="text" readonly  class="form-control"  value="<?php echo $data_pengaduan['nama'];  ?>">
										</div>
										<div class="form-group">
											<label for="">Foto</label>
											<br>
											<img src="../foto/<?php echo $data_pengaduan['foto'];  ?>" style="width: 80%" alt="" class="img-fluid">
										</div>
										<div class="form-group">
											<label for="">Kecamatan</label>
											<textarea name="" id=""  class="form-control"><?php echo $data_pengaduan['kecamatan'];  ?></textarea>
										</div>
										<div class="form-group">
											<label for="">Alamat</label>
											<textarea name="" id=""  class="form-control"><?php echo $data_pengaduan['alamat'];  ?></textarea>
										</div>
										<div class="form-group">
											<label for="">Jenis Bencana</label>
											<textarea name="" id=""  class="form-control"><?php echo $data_pengaduan['jenis_bencana'];  ?></textarea>
										</div>
										<div class="form-group">
											<label for="">Penyebab</label>
											<textarea name="" id=""  class="form-control"><?php echo $data_pengaduan['penyebab'];  ?></textarea>
										</div>
										<div class="form-group">
											<label for="">Kebutuhan</label>
											<textarea name="" id=""  class="form-control"><?php echo $data_pengaduan['kebutuhan'];  ?></textarea>
										</div>
										<hr>
										<div class="form-group">
											<label for="">Tanggapan Anda</label>
											<textarea name="tanggapan" id=""  class="form-control"></textarea>
										</div>
									</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
									<button type="submit" name="tanggapi" class="btn btn-primary">Tanggapi</button>
								</form>
								</div>
								</div>
							</div>
							</div>

							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#batalLaporan<?php echo $data_pengaduan['id_pengaduan']; ?>">Batalkan</button>


						<!-- Modal -->
					<div class="modal fade" id="batalLaporan<?php echo $data_pengaduan['id_pengaduan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
					    		<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Tolak Laporan ini?</h5>						
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Jika Tolak Laporan ini, Maka Akan Masuk Ke Pengaduan Batal.</p>
									<form action="" method="post">
									<input type="hidden" name="id" value="<?php echo $data_pengaduan['id_pengaduan'];  ?>">
										<div class="form-group">
											<label for="">NIK</label>
											<input type="text" readonly  class="form-control"  value="<?php echo $data_pengaduan['nik'];  ?>">
										</div>
										<div class="form-group">
											<label for="">Nama</label>
											<input type="text" readonly  class="form-control"  value="<?php echo $data_pengaduan['nama'];  ?>">
										</div>
										<div class="form-group">
											<label for="">Foto</label>
											<br>
											<img src="../foto/<?php echo $data_pengaduan['foto'];  ?>" style="width: 80%" alt="" class="img-fluid">
										</div>
										<div class="form-group">
											<label for="">Video</label>
											
											<br>
											<video src="../video/<?php echo $data_pengaduan['video'];  ?>" style="width: 80%" alt="" class="object-fit-contain" controls>
												<br>
										</div>
										<div class="form-group">
											<label for="">Kecamatan</label>
											<textarea name="" id=""  class="form-control"><?php echo $data_pengaduan['kecamatan'];  ?></textarea>
										</div>
										<div class="form-group">
											<label for="">Alamat</label>
											<textarea name="" id=""  class="form-control"><?php echo $data_pengaduan['alamat'];  ?></textarea>
										</div>
										<div class="form-group">
											<label for="">Jenis Bencana</label>
											<textarea name="" id=""  class="form-control"><?php echo $data_pengaduan['jenis_bencana'];  ?></textarea>
										</div>
										<div class="form-group">
											<label for="">Penyebab</label>
											<textarea name="" id=""  class="form-control"><?php echo $data_pengaduan['penyebab'];  ?></textarea>
										</div>
										<div class="form-group">
											<label for="">Kebutuhan</label>
											<textarea name="" id=""  class="form-control" ><?php echo $data_pengaduan['kebutuhan'];  ?></textarea>
										</div>
										<hr>
										<div class="form-group">
											<label for="">Alasan Dibatalkan</label>
											<textarea name="tanggapan" class="form-control" id="" cols="30" rows="10"></textarea>
										</div>

									</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
									<button type="submit" name="batal" class="btn btn-primary">Kirim Alasan</button>
								</form>
								</div>
							</div>
						</div>
					</div>
												
				</td>
				</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php

if(isset($_POST['batal'])) {
	$id = $_POST['id'];
	$id_petugas = $_SESSION['admin']['id_petugas'];
	$tgl_tanggapan = date('y-m-d');
	$tanggapan = $_POST['tanggapan'];

	$query = mysqli_query($koneksi, "UPDATE pengaduan SET status ='batal' WHERE id_pengaduan = '$id'") or die(mysqli_error($koneksi));

	if($query) {

		$query_tanggapan = mysqli_query($koneksi, "INSERT INTO tanggapan(id_pengaduan, tgl_tanggapan, tanggapan, id_petugas)
										VALUES('$id','$tgl_tanggapan','$tanggapan','$id_petugas')") or die(mysqli_error($koneksi));

		echo "<script>alert('Berhasil Batalkan Laporan'); </script>";
		   echo "<script> document.location.href='?halaman=pengaduanproses';</script>";
	} else {
		echo "<script>alert('Gagal Batalkan Laporan'); </script>";
		   echo "<script> document.location.href='?halaman=pengaduanproses';</script>";
	}
}

if(isset($_POST['tanggapi'])) {

	$tanggal_tanggapan = date('y-m-d');
	$id_pengaduan = $_POST['id_pengaduan'];
	$id_petugas = $_POST['id_petugas'];
	$tanggapan = $_POST['tanggapan'];

	$query_tanggapan = mysqli_query($koneksi, "INSERT INTO tanggapan(id_pengaduan, tgl_tanggapan, tanggapan, id_petugas )
									VALUES('$id_pengaduan','$tanggal_tanggapan','$tanggapan','$id_petugas')") or die(mysqli_error($koneksi));
	
	if($query_tanggapan) {
		$query_pengaduan = mysqli_query($koneksi, "UPDATE pengaduan SET status ='selesai' WHERE id_pengaduan = '$id_pengaduan'" ) or die(mysqli_error($koneksi));

		echo "<script>alert('Berhasil Menanggapi Laporan'); </script>";
       	echo "<script> document.location.href='?halaman=pengaduanproses';</script>";

	} else {
		echo "<script>alert('Gagal Menanggapi Laporan'); </script>";
       	echo "<script> document.location.href='?halaman=pengaduanproses';</script>";
	}

}

?>