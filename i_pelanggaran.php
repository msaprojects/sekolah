<?php

require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $nis = $_POST['nis'];
        $idkat_pelanggaran = $_POST['idkat_pelanggaran'];
        $keterangan = $_POST['keterangan'];
        $point = $_POST['point'];
        $tanggal = $_POST['tanggal'];
        $tindakan = $_POST['tindakan'];
        $idpengguna = $_POST['idpengguna'];

        $sql = "INSERT INTO pelanggaran (nis, idkat_pelanggaran, keterangan, point, tanggal, tindakan, timestamp, idpengguna) VALUES ('$nis', '$idkat_pelanggaran', '$keterangan', '$point', STR_TO_DATE('$tanggal', '%d-%m-%Y'), $tindakan, NOW(), $idpengguna);";

        if(mysqli_query($con, $sql)){
            echo 'Pelanggaran Berhasil Ditambahkan!';
            echo $sql;
        }else{
            echo 'Pelanggaran Gagal Ditambahkan!';
            echo $sql;
        }
        mysqli_close($con);
    }
?>