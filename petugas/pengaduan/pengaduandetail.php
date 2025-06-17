<?php

$id_pengaduan = $_GET['id_pengaduan'];

$query_pengaduan = mysqli_query($koneksi, "SELECT * FROM pengaduan JOIN masyarakat ON pengaduan.nik=masyarakat.nik WHERE id_pengaduan = '$id_pengaduan'") or die(mysqli_error($koneksi));

$query_tanggapan =mysqli_query($koneksi, "SELECT * FROM tanggapan JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE id_pengaduan = '$id_pengaduan'") or die(mysqli_error($koneksi));

?>

<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
  <div class="breadcrumb-title pr-3">Pengaduan</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Data Pengaduan Selesai</li>
            </ol>
        </nav>
    </div>
    <div class="ml-auto">
        
    </div>
</div>

<?php

    while($pengaduan = $query_pengaduan->fetch_assoc()){

    

?>
<!--end breadcrumb-->
<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Data Pengaduan Selesai</h4>
        </div>
        <hr/>
            <div class="form-group">
                <label for="">Status</label>
                <p><?php echo strtoupper($pengaduan['status']); ?></p>
            </div>
             <div class="from-group">
                <label for="">Tanggal Pengaduan</label>
                <input type="text" name="" value="<?php echo $pengaduan['tgl_pengaduan'];  ?>" id="" class="form-control">
            </div>
            <div class="from-group">
                <label for="">NIK</label>
                <input type="text" name="" value="<?php echo $pengaduan['nik'];  ?>" id="" class="form-control">
            </div>
            <div class="from-group">
                <label for="">Nama Pengirim</label>
                <input type="text" name="" value="<?php echo $pengaduan['nama'];  ?>" id="" class="form-control">
            </div>
            <div class="from-group">
                <label for="">Foto</label>
                <br>
                <img src="../foto/<?php echo $pengaduan['foto'];  ?>" style="width: 50%" alt="" class="img-fluid">
            </div>
            <div class="form-group">
                <label for="">Video</label>
                <br>
                <video src="../video/<?php echo $pengaduan['video']; ?>" class="object-fit-contain" style="width: 50%" controls></video>
            </div>
            <div class="from-group">
                <label for="">Kecamatan</label>
                <input type="text" name="" value="<?php echo $pengaduan['kecamatan'];  ?>" id="" class="form-control">
            </div>
            <div class="from-group">
                <label for="">Alamat</label>
                <input type="text" name="" value="<?php echo $pengaduan['alamat'];  ?>" id="" class="form-control">
            </div>
            <div class="from-group">
                <label for="">Jenis Bencana</label>
                <input type="text" name="" value="<?php echo $pengaduan['jenis_bencana']; ?>" id="" class="form-control">
            </div>
            <div class="from-group">
                <label for="">Penyebab</label>
                <input type="text" name="" value="<?php echo $pengaduan['penyebab']; ?>" id="" class="form-control">
            </div>
            <div class="from-group">
                <label for="">Kebutuhan</label>
                <input type="text" name="" value="<?php echo $pengaduan['kebutuhan']; ?>" id="" class="form-control">
            </div>
            <br>
            <button onclick="return window.history.back();" type="button" class="btn-sm btn-secondary btn">Kembali</button>
    </div>
</div>

<?php } ?>

<?php

while($tanggapan = $query_tanggapan->fetch_assoc()){

?>
<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Tanggapan Petugas</h4>
        </div>
        <hr/>
        <div class="form-group">
            <label for="">Tanggal Tanggapan</label>
            <input type="text" name="" value="<?php echo $tanggapan['tgl_tanggapan']; ?>" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Nama Petugas</label>
            <input type="text" name="" value="<?php echo $tanggapan['nama_petugas']; ?> [<?php echo strtoupper($tanggapan['level']); ?>]" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Tanggapan Petugas</label>
            <textarea name="" id="" cols="30" rows="10" class="form-control"><?php echo $tanggapan['tanggapan']; ?></textarea>
        </div>
    </div>
</div>


<?php } ?>