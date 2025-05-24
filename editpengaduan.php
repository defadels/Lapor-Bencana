<?php

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
                                        <textarea name="kecamatan" id=""  cols="30" rows="10" class="form-control"><?php echo $data['kecamatan'];?></textarea>
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
                                        <input type="file" name="foto" id="" value="<?php echo $data['foto']; ?>"  class="form-control">
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
            $rt = $_POST['rt'];
            $rw = $_POST['rw'];
            $jenis_bencana = $_POST['jenis_bencana'];
            $penyebab = $_POST['penyebab'];
            $dampak_kerugian = $_POST['dampak_kerugian'];
            $kebutuhan = $_POST['kebutuhan'];

            $query_show = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan='$id'")or die (mysqli_error($koneksi));
            $data_lama = $query_show->fetch_assoc();

            if($_FILES['foto']['name'] == null ){
                $foto = $data_lama['foto'];
            } else {

                $foto = $_FILES['foto']['name'];
                unlink("foto/".$data_lama['foto']);

                $lokasi = $_FILES['foto']['tmp_name'];
                move_uploaded_file($lokasi, "foto/".$foto); 

            }

            $query=mysqli_query($koneksi, "UPDATE pengaduan SET tgl_pengaduan = '$tanggal', rt = '$rt', rw = '$rw', jenis_bencana = '$jenis_bencana', penyebab = '$penyebab', dampak_kerugian = '$dampak_kerugian', kebutuhan = '$kebutuhan', foto = '$foto' 
                                WHERE id_pengaduan = '$id'") or die(mysqli_error($koneksi));

            if($query) {
                echo "<script>alert('Berhasil Mengubah Laporan'); </script>";
                echo "<script> document.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Gagal Mengubah Laporan'); </script>";
                echo "<script> document.location.href='tambahpengaduan.php';</script>";
            }
   
}
?>
