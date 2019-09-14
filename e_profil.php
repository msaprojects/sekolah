<?php
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $idbiodata = $_POST['idbiodata'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $tmplahir = $_POST['tempat_lahir'];
        $thmasuk = $_POST['th_masuk'];
        $pendidikan = $_POST['pendidikan_akhir'];
        $studi = $_POST['studi'];
        $idpengguna = $_POST['idpengguna'];
       
        $sql = "UPDATE pegawai SET nik='$nik', nama='$nama', alamat='$alamat', email='$email', tempat_lahir='$tmplahir', th_masuk='$thmasuk', pendidikan_akhir='$pendidikan', studi='$studi', edited=curdate(), idpengguna='$idpengguna' WHERE nip='$idbiodata';";
        if(mysqli_multi_query($con, $sql)){
            echo 'Data Berhasil diubah';
        }else{
            echo 'Data Gagal diubah, Harap Coba lagi...';
            echo $sql;
        }
        mysqli_close($con);
    }
?>