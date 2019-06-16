<?php

require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $nis = $_POST['nis'];
        // $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];
        $idpengguna = $_POST['idpengguna'];
        $cek = "select * from absensi_bk where nis='$nis' and tanggal=DATE(NOW())";
        $recordcount = mysqli_query($con, $cek);
        
        if(mysqli_num_rows($recordcount)==0){
            $sql = "INSERT INTO absensi_bk (nis, keterangan, jam, tanggal, timestamp, idpengguna) VALUES ('$nis', '$keterangan', TIME(NOW()), NOW(), NOW(), 3);";
        }else{
          $sql = "UPDATE absensi_bk SET keterangan='$keterangan' where nis='$nis' and tanggal=DATE(NOW());";
        }

        if(mysqli_query($con, $sql)){
            
            require_once('notification.php');
            $notification = new Notification();
            $tokenbk = mysqli_fetch_row(mysqli_query($con, "select token from pengguna where id_biodata='$nis';"));
            $nama = mysqli_fetch_row(mysqli_query($con, "select nama from siswa where nis='$nis';"));
            $result = $notification->sendFCMSingle("", "", $tokenbk[0], $notification->setNotification("Absensi", $nama[0]." Absen pada pukul".date("H:i")));

            
            echo 'Absen Siswa Berhasil';
            echo $cek." adu ".$sql;
            echo mysqli_num_rows($recordcount);
        }else{
            echo 'Izin Untuk anak anda di tolak';
            echo $sql;
        }
        mysqli_close($con);
    }
?>