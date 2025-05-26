<?php
require_once 'config/kecamatan.php';
?>

    <div class="col-12 col-lg-10 mx-auto">
        <div class="card radius-15">
            <div class="card-header text-center">
                <h3 class="mt-4 font-weight-bold">Tambah Laporan</h3>
            </div>
            <div class="card-body p-md-5">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tgl_pengaduan" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kecamatan</label>
                        <select name="kecamatan" class="form-control" id="select2" required>
                            <option value="">-- Pilih Kecamatan --</option>
                            <?php foreach($kecamatan as $kec): ?>
                                <option value="<?= $kec ?>"><?= $kec ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Bencana</label>
                        <textarea name="jenis_bencana" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Penyebab Bencana</label>
                        <textarea name="penyebab" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Dampak Kerugian</label>
                        <textarea name="dampak_kerugian" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Kebutuhan</label>
                        <textarea name="kebutuhan" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Foto</label>
                        <input type="file" name="foto" id="" class="form-control" accept="image/*">
                        <small class="text-muted">Format: jpg, jpeg, png. Maksimal 2MB</small>
                    </div>
                    <div class="form-group">
                        <label for="">Video</label>
                        <input type="file" name="video" id="" class="form-control" accept="video/*">
                        <small class="text-muted">Format: mp4, avi, mkv. Maksimal 50MB</small>
                    </div>
                    <button onclick="window.history.back()" class="btn btn-sm btn-secondary" type="button">Kembali</button>
                    <button name="submit" class="btn btn-sm btn-info" type="submit">Submit</button>
                </form>
            </div>
        </div>

        <?php
        if(isset($_POST['submit'])) {
            $nik = $_SESSION['masyarakat']['nik'];
            $tanggal = $_POST['tgl_pengaduan'];
            $kecamatan = $_POST['kecamatan'];
            $alamat = $_POST['alamat'];
            $jenis_bencana = $_POST['jenis_bencana'];
            $penyebab = $_POST['penyebab'];
            $dampak_kerugian = $_POST['dampak_kerugian'];
            $kebutuhan = $_POST['kebutuhan'];
            $status = 0;

            // Upload foto
            $foto = $_FILES['foto']['name'];
            $lokasi_foto = $_FILES['foto']['tmp_name'];
            $ekstensi_diperbolehkan_foto = array('png','jpg','jpeg');
            $x = explode('.', $foto);
            $ekstensi_foto = strtolower(end($x));
            $ukuran_foto = $_FILES['foto']['size'];
            $foto_baru = uniqid() . "." . $ekstensi_foto;

            // Upload video
            $video = $_FILES['video']['name'];
            $lokasi_video = $_FILES['video']['tmp_name'];
            $ekstensi_diperbolehkan_video = array('mp4','avi','mkv');
            $x = explode('.', $video);
            $ekstensi_video = strtolower(end($x));
            $ukuran_video = $_FILES['video']['size'];
            $video_baru = uniqid() . "." . $ekstensi_video;

            // Validasi foto
            if(in_array($ekstensi_foto, $ekstensi_diperbolehkan_foto) && $ukuran_foto <= 2000000) {
                move_uploaded_file($lokasi_foto, "foto/" . $foto_baru);
            } else {
                echo "<script>alert('Format atau ukuran foto tidak sesuai!'); </script>";
                return;
            }

            // Validasi video
            if($video != '') {
                if(in_array($ekstensi_video, $ekstensi_diperbolehkan_video) && $ukuran_video <= 50000000) {
                    move_uploaded_file($lokasi_video, "video/" . $video_baru);
                } else {
                    echo "<script>alert('Format atau ukuran video tidak sesuai!'); </script>";
                    return;
                }
            } else {
                $video_baru = null;
            }

            $query = mysqli_query($koneksi, "INSERT INTO pengaduan (tgl_pengaduan, nik, kecamatan, alamat, jenis_bencana, penyebab, dampak_kerugian, kebutuhan, foto, video, status)
                        VALUES('$tanggal','$nik','$kecamatan','$alamat','$jenis_bencana','$penyebab','$dampak_kerugian','$kebutuhan','$foto_baru','$video_baru','$status')") or die(mysqli_error($koneksi));

            if($query) {
                echo "<script>alert('Berhasil Tambah Laporan'); </script>";
                echo "<script> document.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Gagal Tambah Laporan'); </script>";
                echo "<script> document.location.href='tambahpengaduan.php';</script>";
            }
        }
        ?>
    </div>


