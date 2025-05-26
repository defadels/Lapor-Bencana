<?php
require_once 'config/kecamatan.php';
$id = $_GET['id_pengaduan'];
$data_pengaduan = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id'") or die(mysqli_error($koneksi));

while($data = $data_pengaduan->fetch_assoc()){

?>
<div class="col-12 col-lg-10 mx-auto">
                        <div class="card radius-15">
                            <div class="card-header text-center">
                                <h3 class="mt-4 font-weight-bold">Edit Laporan</h3>
                            </div>
                            <div class="card-body p-md-5">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input type="date" name="tgl_pengaduan" id="" value="<?php echo $data['tgl_pengaduan']  ?>"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kecamatan</label>
                                        <select name="kecamatan" class="form-control" id="select2" required>
                                            <option value="">-- Pilih Kecamatan --</option>
                                            <?php foreach($kecamatan as $kec): ?>
                                                <option value="<?= $kec ?>" <?= ($kec == $data['kecamatan']) ? 'selected' : '' ?>><?= $kec ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" id=""  cols="30" rows="10" class="form-control"><?php echo $data['alamat'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenis Bencana</label>
                                        <textarea name="jenis_bencana" id=""  cols="30" rows="10" class="form-control"><?php echo $data['jenis_bencana'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Penyebab Bencana</label>
                                        <textarea name="penyebab" id="" cols="30" rows="10" class="form-control"><?php echo $data['penyebab'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Dampak Kerugian</label>
                                        <textarea name="dampak_kerugian" id="" cols="30" rows="10" class="form-control"><?php echo $data['dampak_kerugian'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kebutuhan</label>
                                        <textarea name="kebutuhan" id=""  cols="30" rows="10" class="form-control"><?php echo $data['kebutuhan'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Foto</label>
                                        <?php if($data['foto']) { ?>
                                            <br>
                                            <img src="foto/<?php echo $data['foto']; ?>" style="width: 150px" class="mb-3">
                                        <?php } ?>
                                        <input type="file" name="foto" id="" class="form-control" accept="image/*">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Video</label>
                                        <?php if($data['video']) { ?>
                                            <br>
                                            <video width="200" controls class="mb-3">
                                                <source src="video/<?php echo $data['video']; ?>" type="video/mp4">
                                                Browser Anda tidak mendukung tag video.
                                            </video>
                                        <?php } ?>
                                        <input type="file" name="video" id="" class="form-control" accept="video/*">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah video</small>
                                    </div>
                                    <button onclick="window.history.back()" class="btn btn-sm btn-secondary" type="button">Kembali</button>
                                    <button name="submit" class="btn btn-sm btn-info" type="submit">Submit</button>
                                </form>
                            
                            </div>
                        </div>

<?php

}
        if(isset($_POST['submit'])) {
            $tanggal = $_POST['tgl_pengaduan'];
            $kecamatan = $_POST['kecamatan'];
            $alamat = $_POST['alamat'];
            $jenis_bencana = $_POST['jenis_bencana'];
            $penyebab = $_POST['penyebab'];
            $dampak_kerugian = $_POST['dampak_kerugian'];
            $kebutuhan = $_POST['kebutuhan'];

            $query_show = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan='$id'")or die (mysqli_error($koneksi));
            $data_lama = $query_show->fetch_assoc();

            // Handle foto
            if($_FILES['foto']['name'] == null ){
                $foto = $data_lama['foto'];
            } else {
                $foto = $_FILES['foto']['name'];
                $ekstensi_diperbolehkan_foto = array('png','jpg','jpeg');
                $x = explode('.', $foto);
                $ekstensi_foto = strtolower(end($x));
                $ukuran_foto = $_FILES['foto']['size'];
                $foto_tmp = $_FILES['foto']['tmp_name'];
                
                if(in_array($ekstensi_foto, $ekstensi_diperbolehkan_foto) && $ukuran_foto <= 2000000) {
                    if($data_lama['foto']) {
                        unlink("foto/".$data_lama['foto']);
                    }
                    $foto_baru = uniqid() . "." . $ekstensi_foto;
                    move_uploaded_file($foto_tmp, "foto/".$foto_baru);
                    $foto = $foto_baru;
                } else {
                    echo "<script>alert('Format atau ukuran foto tidak sesuai!'); </script>";
                    return;
                }
            }

            // Handle video
            if($_FILES['video']['name'] == null ){
                $video = $data_lama['video'];
            } else {
                $video = $_FILES['video']['name'];
                $ekstensi_diperbolehkan_video = array('mp4','avi','mkv');
                $x = explode('.', $video);
                $ekstensi_video = strtolower(end($x));
                $ukuran_video = $_FILES['video']['size'];
                $video_tmp = $_FILES['video']['tmp_name'];
                
                if(in_array($ekstensi_video, $ekstensi_diperbolehkan_video) && $ukuran_video <= 50000000) {
                    if($data_lama['video']) {
                        unlink("video/".$data_lama['video']);
                    }
                    $video_baru = uniqid() . "." . $ekstensi_video;
                    move_uploaded_file($video_tmp, "video/".$video_baru);
                    $video = $video_baru;
                } else {
                    echo "<script>alert('Format atau ukuran video tidak sesuai!'); </script>";
                    return;
                }
            }

            $query = mysqli_query($koneksi, "UPDATE pengaduan SET 
                tgl_pengaduan = '$tanggal', 
                kecamatan = '$kecamatan', 
                alamat = '$alamat', 
                jenis_bencana = '$jenis_bencana', 
                penyebab = '$penyebab', 
                dampak_kerugian = '$dampak_kerugian', 
                kebutuhan = '$kebutuhan', 
                foto = '$foto',
                video = '$video'
                WHERE id_pengaduan = '$id'") or die(mysqli_error($koneksi));

            if($query) {
                echo "<script>alert('Berhasil Mengubah Laporan'); </script>";
                echo "<script> document.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Gagal Mengubah Laporan'); </script>";
                echo "<script> document.location.href='editpengaduan.php?id_pengaduan=".$id."';</script>";
            }
   
}
?>
