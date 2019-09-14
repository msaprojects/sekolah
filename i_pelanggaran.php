<?php
header('Content-Type: charset=utf-8');
date_default_timezone_set('Asia/Jakarta');
require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $nis = $_POST['nis'];
        $idpoint_pelanggaran = $_POST['idpoint_pelanggaran'];
        $keterangan = $_POST['keterangan'];
        $tanggal = $_POST['tanggal'];
        $idpengguna = $_POST['idpengguna'];

        $sql = "INSERT INTO pelanggaran (idpoint_pelanggaran, nis, keterangan, tanggal, timestamp, idpengguna) VALUES ('$idpoint_pelanggaran', '$nis', '$keterangan', STR_TO_DATE('$tanggal', '%d-%m-%Y'), NOW(), '$idpengguna');";

        if(mysqli_query($con, $sql)){
            require_once('notification.php');
            $notification = new Notification();
            $tokenbk = mysqli_fetch_row(mysqli_query($con, "select p.token from pengguna p where p.id_biodata=$nis;"));
            $result = $notification->sendFCMSingle("", "", $tokenbk[0], $notification->setNotification("Pelanggaran", "Anda Melakukan Pelanggaran Di Sekolah."));

            echo 'Pelanggaran Berhasil Ditambahkan!';
            echo $sql;
        }else{
            echo 'Pelanggaran Gagal Ditambahkan!';
            echo $sql;
        }
        mysqli_close($con);
    }
?>