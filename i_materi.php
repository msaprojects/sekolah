<?php
header('Content-Type: charset=utf-8');
date_default_timezone_set('Asia/Jakarta');
require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $tanggal = $_POST['tanggal'];
        $judul = $_POST['judul'];
        $materi = $_POST['materi'];
        $tugas = $_POST['tugas'];
        $judul_tugas = $_POST['judul_tugas'];
        $tgl_akhir_tugas = $_POST['tgl_akhir_tugas'];
        $idjadwal_pelajaran = $_POST['idjadwal_pelajaran'];
        $idpengguna = $_POST['idpengguna'];

        $sql = "INSERT INTO materi (tanggal, judul, materi, tugas, judul_tugas, tgl_akhir_tugas, idjadwal_pelajaran, idpengguna) values (STR_TO_DATE('$tanggal', '%d-%m-%Y'), '$judul', '$materi', '$tugas', '$judul_tugas', STR_TO_DATE('$tgl_akhir_tugas', '%d-%m-%Y'), '$idjadwal_pelajaran', '$idpengguna' );";

        if(mysqli_query($con, $sql)){
           
            echo 'Materi Berhasil Ditambahkan!';

        }else{
            echo 'Pelanggaran Gagal Ditambahkan!';
            echo $sql;
        }
        mysqli_close($con);
    }
?>