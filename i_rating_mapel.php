<?php
header('Content-Type: charset=utf-8');
date_default_timezone_set('Asia/Jakarta');
require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $nilai = $_POST['nilai'];
        $idjadwal_pelajaran = $_POST['idjadwal_pelajaran'];
        $idpengguna = $_POST['idpengguna'];

        $sql = "INSERT INTO rating_mapel (tanggal, nilai, idpengguna, idjadwal_pelajaran, timestamp) values (CURDATE(), '$nilai', '$idpengguna', '$idjadwal_pelajaran', now());";

        if(mysqli_query($con, $sql)){
           
            echo 'Materi Berhasil Ditambahkan!';

        }else{
            echo 'Pelanggaran Gagal Ditambahkan!';
            echo $sql;
        }
        mysqli_close($con);
    }
?>