<?php
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $idizin = $_POST['idizin'];
       
        $sql = "UPDATE izin_kelas SET approve=1 WHERE idizin_kelas='$idizin'";

        if(mysqli_query($con, $sql)){
             require_once('notification.php');
            $notification = new Notification();
            $tokenbk = mysqli_fetch_row(mysqli_query($con, "select token from pengguna where id_biodata=(select nis from izin_kelas where idizin_kelas='$idizin');;"));
            $result = $notification->sendFCMSingle("", "", $tokenbk[0], $notification->setNotification("IZIN", "Izin Anda Disetujui."));
            
            if($path1!="") file_put_contents($path1, base64_decode($image1));
            echo 'Izin Berhhasil Di setujui';
        }else{
            echo 'Izin Di tolak';
            echo $sql;
        }
        mysqli_close($con);
    }
?>