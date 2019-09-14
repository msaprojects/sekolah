<?php
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $idpengguna = $_POST['idpengguna'];
        $token = $_POST['token'];
       
        $sql = "UPDATE pengguna SET token='$token', aktif=1 WHERE idpengguna='$idpengguna'";

        if(mysqli_query($con, $sql)){
            if($path1!="") file_put_contents($path1, base64_decode($image1));
            echo 'Izin Berhhasil Di setujui';
        }else{
            echo 'Izin Di tolak';
            echo $sql;
        }
        mysqli_close($con);
    }
?>