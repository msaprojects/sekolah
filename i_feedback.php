<?php
header('Content-Type: charset=utf-8');
date_default_timezone_set('Asia/Jakarta');
require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $feedback = $_POST['feedback'];
        $jenis = $_POST['jenis'];
        $idpengguna = $_POST['idpengguna'];

        $sql = "INSERT INTO feedback (feedback, jenis, idpengguna, timestamp) VALUES ('$feedback', '$jenis', '$idpengguna');";

        if(mysqli_query($con, $sql)){
           
            echo 'Feedback Berhasil Ditambahkan!';

        }else{
            echo 'Feedback Gagal Ditambahkan!';
            echo $sql;
        }
        mysqli_close($con);
    }
?>