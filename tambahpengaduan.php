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
                                        <textarea name="kecamatan" id="" cols="30" rows="10" class="form-control"></textarea>
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
                                        <input type="file" name="foto" id="" class="form-control">
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

    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "foto/".$foto); 


    $query=mysqli_query($koneksi, "INSERT INTO pengaduan (tgl_pengaduan, nik, kecamatan, alamat, jenis_bencana, penyebab, dampak_kerugian, kebutuhan, foto, status)
                    VALUES('$tanggal','$nik','$kecamatan','$alamat','$jenis_bencana','$penyebab','$dampak_kerugian','$kebutuhan','$foto','$status')") or die(mysqli_error($koneksi));

    if($query) {
        echo "<script>alert('Berhasil Tambah Laporan'); </script>";
        echo "<script> document.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal Tambah Laporan'); </script>";
        echo "<script> document.location.href='tambahpengaduan.php';</script>";
    }
   
}
?>
