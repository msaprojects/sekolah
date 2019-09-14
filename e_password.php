<?php
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $idpengguna = $_POST['idpengguna'];
        $password = $_POST['password'];
       
        $sql = "UPDATE pengguna SET password='$password' WHERE idpengguna='$idpengguna';";
        $sql .= "INSERT INTO log(idlog_action, keterangan,idpengguna) VALUES (2, 'ubah password', $idpengguna);";

        if(mysqli_multi_query($con, $sql)){
            if($path1!="") file_put_contents($path1, base64_decode($image1));
            echo 'Password Berhasil diubah';
        }else{
            echo 'Password Gagal diubah, Harap Coba lagi...';
            echo $sql;
        }
        mysqli_close($con);
    }
?>