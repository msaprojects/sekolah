<?php

header('Content-Type: charset=utf-8');

require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $idpengguna = $_POST['idpengguna'];
        
        $timestamp = 'now()';
        $path1 = "";
        $image1 = "";

        if (isset($_POST['actualpath'])) $actualpath = $_POST['actualpath'];
      
        if(isset($_POST['gambar'])) {
            $timestamp = date('Y_m_d__H_i_s');
            $image1 = $_POST['gambar'];
            $path1 = "gambar/informasi-$judul-$timestamp.jpg";
          $actualpath1 = $actualpath.$path1;
        }else{
            $image1 = "";
            $path1 = "";
        }           

        $sql = "INSERT INTO informasi (judul, deskripsi, gambar, idkat_informasi, idpengguna) VALUES ('$judul', '$deskripsi', '$actualpath1', '1', '$idpengguna');";

        if(mysqli_query($con, $sql)){
            
                require_once('notification.php');
            $notification = new Notification();
            $result = $notification->sendFCMMultiple("topic", "topic", "", $notification->setNotification("Informasi", "Ada informasi baru."));
            
          echo 'Berhasil Menambahkan Informasi '.$result;
            
            if($path1!="") file_put_contents($path1, base64_decode($image1));
            
        }else{
            echo 'Gagal Menambahkan Informasi';
            echo $sql;
        }
        mysqli_close($con);
    }
?>