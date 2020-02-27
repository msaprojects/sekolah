<?php
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $nis = $_POST['nis'];
        $keterangan = $_POST['keterangan'];
        $idpengguna = $_POST['idpengguna'];
        $idjadwal_pelajaran = $_POST['idjadwal_pelajaran'];

        $cek = "SELECT * from absensi_bk where nis='$nis' and tanggal=CURDATE()";
        $recordcount = mysqli_query($con, $cek);
        
        if(mysqli_num_rows($recordcount)==0){
            $sql = "INSERT INTO absen_mapel (idjadwal_pelajaran, nis, keterangan, jam, tanggal, timestamp, idpengguna) VALUES ('$idjadwal_pelajaran', '$nis', '$keterangan', CURTIME(), CURDATE(), NOW(), '$idpengguna');";
        }else{
            $sql = "UPDATE absen_mapel SET keterangan='$keterangan' where nis='$nis' and tanggal=CURDATE();";
        }

        if(mysqli_query($con, $sql)){
            
            // require_once('notification.php');
            // $notification = new Notification();
            // $tokenbk = mysqli_fetch_row(mysqli_query($con, "select token from pengguna where id_biodata='$nis';"));
            // $nama = mysqli_fetch_row(mysqli_query($con, "select nama from siswa where nis='$nis';"));
            // $result = $notification->sendFCMSingle("", "", $tokenbk[0], $notification->setNotification("Absensi", "Hari ini ".$nama[0]." status absensinya ".$keterangan));
            
            echo $sql;
            echo 'Absen Siswa Berhasil';
        }else{
            echo 'Izin Untuk anak anda di tolak';
            echo $sql;
        }
        mysqli_close($con);
    }
?>