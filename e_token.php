<?php
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $idpengguna = $_POST['idpengguna'];
        // $idjabatan = $_POST['idjabatan'];
        // $cekmasuk = "SELECT * from pengguna where idpengguna=$idpengguna and idjabatan=$idjabatan";
        // $run = mysqli_query($con, $cekmasuk) ;
        // $row = mysqli_fetch_array($run);
        // if(!empty($row)){
            $token = $_POST['token'];
    
            $sql = "UPDATE pengguna SET token='$token', aktif=1 WHERE idpengguna='$idpengguna'";

            if(mysqli_query($con, $sql)){
                echo 'Selamat Datang';
            }else{
                echo 'Anda tidak endapatkan token';
                echo $sql;
            }
            mysqli_close($con);    
        // }else{
        //     echo 'Anda Harus Login Kembali';
        // }
    }
?>