<?php

    $id = $_GET['id_petugas'];

    $query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas = '$id'") or die(mysqli_error($koneksi));

    while($petugas = $query->fetch_assoc()){

    

?>
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Petugas</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Edit Data Petugas</li>
								</ol>
							</nav>
						</div>			
					</div>
    <!--end breadcrumb-->
    <div class="card radius-15">
        <div class="card-body">
            <div class="card-title">
                <h4 class="mb-0">Edit Data Petugas</h4>
            </div>
            <hr/>
            <form method="POST">
            <div class="form-group">
                <label for="">Nama Petugas</label>
                <input type="text" value="<?php echo  $petugas['nama_petugas']; ?>" class="form-control" name="nama_petugas" placeholder="Masukan Nama Petugas">
            </div>
            <div class="form-group">
                <label for="">Telepon</label>
                <input type="text" value="<?php echo  $petugas['telp']; ?>" maxlength="13" class="form-control" name="telp" placeholder="Masukan Nomor Telepon">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text"  value="<?php echo  $petugas['username']; ?>"  class="form-control" name="username" placeholder="Masukan Username Petugas">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Ketikan Jika Ingin Diubah">
            </div>
            <div class="form-group">
                <label for="">Level</label>
                <select name="level" id="" class="form-control">
                    <option value="admin" <?php if($petugas['level'] == 'admin') { echo 'selected'; }  ?> >ADMIN</option>
                    <option value="petugas" <?php if($petugas['level'] == 'petugas') { echo 'selected'; } ?> >PETUGAS</option>
                </select>
            </div>
            <button class="btn btn-sm btn-secondary" type="button" onclick="window.history.back();">Kembali</button>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>

<?php
}

if(isset($_POST['submit'])){


    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    $level = $_POST['level'];

    if($_POST['password'] != '' ){

    $query = mysqli_query($koneksi, "UPDATE petugas SET nama_petugas='$nama_petugas', username='$username', 
                        password='$password',  telp='$telp', level='$level' WHERE id_petugas = '$id' ") or die(mysqli_error($koneksi));

    } else {

    $query = mysqli_query($koneksi, "UPDATE petugas SET nama_petugas='$nama_petugas', username='$username', 
                        telp='$telp', level='$level' WHERE id_petugas = '$id' ") or die(mysqli_error($koneksi));
    }

    if($query) {
        echo "<script>alert('Berhasil Edit Data Petugas'); </script>";
        echo "<script> document.location.href='?halaman=petugas';</script>";
    } else {
        echo "<script>alert('Gagal Edit Data Petugas'); </script>";
        echo "<script> document.location.href='?halaman=tambahpetugas';</script>";
    }

    }
?>
            