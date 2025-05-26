<?php

$id = $_GET['id_pengaduan'];

$query_laporan = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id'") or die(mysqli_error($koneksi));

while($pengaduan = $query_laporan->fetch_assoc()) {

?>

<div class="col-12 col-lg-12 mx-auto">
    <div class="card radius-15">
        <div class="card-header text-center">
            <h3 class="mt-4 font-weight-bold">Detail Laporan Kebencanaan</h3>
        </div>
        <div class="card-body p-md-5">
         <div class="form-group">
            <label for="">Tanggal Pengaduan</label>
            <p><?php echo $pengaduan['tgl_pengaduan']; ?></p>

        <div class="form-group">
            <label for="">Kecamatan</label>
            <p><?php echo $pengaduan['kecamatan']; ?></p>
        </div>

        <div class="form-group">
            <label for="">Alamat</label>
            <p><?php echo $pengaduan['alamat']; ?></p>
        </div>

        <div class="form-group">
            <label for="">Jenis Bencana</label>
            <p><?php echo $pengaduan['jenis_bencana']; ?></p>
        </div>

        <div class="form-group">
            <label for="">Penyebab Bencana</label>
            <p><?php echo $pengaduan['penyebab']; ?></p>
        </div>

        <div class="form-group">
            <label for="">Dampak Kerugian</label>
            <p><?php echo $pengaduan['dampak_kerugian']; ?></p>
        </div>

        <div class="form-group">
            <label for="">Kebutuhan</label>
            <p><?php echo $pengaduan['kebutuhan']; ?></p>
        </div>

        <div class="form-group">
            <label for="">Foto Laporan</label>
            <br>
            <img src="foto/<?php echo $pengaduan['foto']; ?>" style="width: 30%"  alt="" class="img-fluid">
        </div>

        <?php if($pengaduan['video']) { ?>
        <div class="form-group">
            <label for="">Video Laporan</label>
            <br>
            <video width="400" controls>
                <source src="video/<?php echo $pengaduan['video']; ?>" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
        </div>
        <?php } ?>

        <div class="form-group">
            <label for="">Status</label>
            <p><?php echo strtoupper($pengaduan['status']); ?></p>
        </div>
        <button onclick="window.history.back()" class="btn btn-sm btn-secondary" type="button">Kembali</button>
    </div>
 </div>

 <?php } ?>

 <?php

$query_tanggapan = mysqli_query($koneksi, "SELECT * FROM tanggapan JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas 
                                WHERE id_pengaduan='$id'")or die(mysqli_error($koneksi));

 ?>

 <div class="col-12 col-lg-12 mx-auto">
    <div class="card radius-15">
        <div class="card-header text-center">
            <h3 class="mt-4 font-weight-bold">Tanggapan Petugas</h3>
        </div>
        <div class="card-body p-md-5">
            <?php
                if($query_tanggapan->num_rows > 0) {
                while($tanggapan = $query_tanggapan->fetch_assoc()){
            ?>
                <div class="form-group">
                    <label for="">Nama Petugas</label>
                    <p><?php echo $tanggapan['nama_petugas']; ?> [<?php echo strtoupper($tanggapan['level']); ?>]</p>
                </div>

                <div class="form-group">
                    <label for="">Isi Tanggapan</label>
                    <p><?php echo $tanggapan['tanggapan']; ?></p>
                </div>
        <?php 
        }
            } else { 
        ?>
        
        <h4 class="text-center">Belum Ada Tanggapan</h4>

        <?php } ?>
    </div>
 </div>

 