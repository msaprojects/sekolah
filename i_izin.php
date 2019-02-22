<?php

require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $alasan = $_POST['alasan'];
        $kategori = $_POST['kategori'];
        $nis = $_POST['nis'];
        $idpengguna = $_POST['idpengguna'];
        $gambar = $_POST['gambar'];
        $approve = $_POST['approve'];
        $timestamp = 'now()';
        $timestamp = $_POST['timestamp'];

        $alasan = "";
        $kategori = "";
        $nis = "2016420031";
        $idpengguna = "1";
        $gambar = "";
        $approve = "0";
        $timestamp = "";
        $timestamp = "";
        $image1="";
        $actualpath = "";
        $actualpath1 = "";

        if (isset($_POST['actualpath'])) $actualpath = $_POST['actualpath'];
      
        if(isset($_POST['gambar'])) {
            $timestamp = date('Y_m_d__H_i_s');
            $image1 = $_POST['gambar'];
            $path1 = "gambar/izin_$kategori_$timestamp.jpg";
            $actualpath1 = $actualpath.$path1;
        }else{
            $image1 = "";
            $path1 = "";
        }           

        $sql = "INSERT INTO izin_kelas (alasan, kategori, approve, nis, gambar, idpengguna) VALUES ('$alasan', '$kategori', '0', '2016420031', '$actualpath1', '1');";

        if(mysqli_query($con, $sql)){
            if($path1!="") file_put_contents($path1, base64_decode($image1));
            echo 'Berhasil Menambahkan Tugas ';
        }else{
            echo 'Gagal Menambahkan Kunjungan';
            echo $sql;
        }
        mysqli_close($con);
    }
?>