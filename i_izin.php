<?php
header('Content-Type: charset=utf-8');
date_default_timezone_set('Asia/Jakarta');
require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $alasan = $_POST['alasan'];
        $kategori = $_POST['kategori'];
        $nis = $_POST['idbiodata'];
        $idpengguna = $_POST['idpengguna'];
        $gambar = $_POST['gambar'];
        $tanggal = $_POST['tanggal'];
        $timestamp = 'now()';


        $approve = "";
        $image1="";
        $actualpath = "";
        $actualpath1 = "";

        if (isset($_POST['actualpath'])) $actualpath = $_POST['actualpath'];
      
        if(isset($_POST['gambar'])) {
            $timestamp = date('Y_m_d__H_i_s');
            $image1 = $_POST['gambar'];
            $path1 = "gambar/izin_$kategori-$timestamp.jpg";
            $actualpath1 = $actualpath.$path1;
        }else{
            $image1 = "";
            $path1 = "";
        }           

        $sql = "INSERT INTO izin_kelas (alasan, kategori, approve, nis, gambar, idpengguna, tanggal) VALUES ('$alasan', '$kategori', '0', '$nis', '$actualpath1', '$idpengguna', STR_TO_DATE('$tanggal', '%d-%m-%Y'));";

        if(mysqli_query($con, $sql)){
            
            require_once('notification.php');
            $notification = new Notification();
            $tokenbk = mysqli_fetch_row(mysqli_query($con, "select p.token from pengguna p, pegawai pg, jabatan j where p.id_biodata=pg.nip and pg.idjabatan=j.idjabatan and j.nama='bk';"));
            $result = $notification->sendFCMSingle("", "", $tokenbk[0], $notification->setNotification("IZIN", "Ada siswa yang izin."));

            
            if($path1!="") file_put_contents($path1, base64_decode($image1));
            echo 'Izin untuk anak anda berhasil di ajukan.';
            echo $result." - ".$tokenbk[0];
        }else{
            echo 'Izin Untuk anak anda di tolak';
            echo $sql;
        }
        mysqli_close($con);
    }
?>