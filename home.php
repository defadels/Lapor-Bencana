<div class="col-12 col-lg-12 mx-auto">
    <div class="card radius-15">
        <div class="card-header text-center">
            <h3 class="mt-4 font-weight-bold">Laporan Kebencanaan</h3>
        </div>
            <div class="card-body p-md-5">
                <a href="?halaman=tambahpengaduan" class="btn btn-primary btn-sm mb-3">+ Tambah Laporan</a>
                                <!-- Hari ini -->
                <div class="table-responsive"> 
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                   <tbody>

                    <?php
                       $nik = $_SESSION['masyarakat']['nik'];

                       $query = mysqli_query($koneksi, "SELECT * FROM pengaduan 
                                           WHERE nik='$nik'") or die(mysqli_error($koneksi));
                        if($query->num_rows >0) {

                        while($pengaduan = $query->fetch_assoc()){

                                        
                     ?>
                        <tr>
                        <th scope="row"><?php echo $pengaduan['tgl_pengaduan']; ?></th>
                        <td>
                        <img src="foto/<?php echo $pengaduan['foto']; ?>" alt="" class="img-fluid">
                        </td>
                        <td>
                        <button class="btn btn-sm btn-<?php if($pengaduan['status'] == '0' ){ echo 'secondary'; }
                                 if($pengaduan['status'] == 'proses' ){ echo 'warning'; }
                                 if($pengaduan['status'] == 'selesai' ){ echo 'success'; }
                                 if($pengaduan['status'] == 'batal' ){ echo 'danger'; } ?>">
                                                        
                            <?php 
                                if($pengaduan['status'] == '0' ){ echo 'Belum Dikonfirmasi'; }
                                if($pengaduan['status'] == 'proses' ){ echo 'Diproses'; }
                                if($pengaduan['status'] == 'selesai' ){ echo 'Selesai'; }
                                if($pengaduan['status'] == 'batal' ){ echo 'Dibatalkan/Ditolak'; } 
                            ?>
                          </button>
                        </td>
                        <td>
                            <?php
                                if($pengaduan['status'] == '0'){                                  
                               
                            ?>
                             <a href="?halaman=editpengaduan&id_pengaduan=<?php echo $pengaduan['id_pengaduan']; ?>" class="btn btn-sm btn-warning">Edit</a>
                             <a onclick="return confirm('Yakin hapus data ini?')" href="?halaman=hapuspengaduan&id_pengaduan=<?php echo $pengaduan['id_pengaduan']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                             <?php
                                 } else {
                                    
                                 
                             ?>
                             <a href="?halaman=detailpengaduan&id_pengaduan=<?php echo $pengaduan['id_pengaduan']; ?>" class="btn btn-sm btn-primary">Lihat Detail</a>
                          </td>
                          </tr>
                     <?php
                           }
                        }
                    } else {
                   
                     ?>
                    </tbody>
                 </table>

                            <h4 class="text-center mt-5">Belum Ada laporan</h4>
                 <?php } ?>

        </div>
    </div>
 </div>