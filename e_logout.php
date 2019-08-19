<?php

require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $idpengguna = $_POST['idpengguna'];
        $token = $_POST['token'];
       
        $sql = "UPDATE pengguna SET token='', aktif=0 WHERE idpengguna='$idpengguna'";

        if(mysqli_query($con, $sql)){
            echo 'Logout Berhasil';
        }else{
            echo 'Logout Gagal';
            echo $sql;
        }
        mysqli_close($con);
    }
?>