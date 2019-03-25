<?php

require_once('koneksi.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $idizin = $_POST['idizin'];
       
        $sql = "UPDATE izin_kelas SET approve=1 WHERE idizin_kelas='$idizin'";

        if(mysqli_query($con, $sql)){
            if($path1!="") file_put_contents($path1, base64_decode($image1));
            echo 'Izin Berhhasil Di setujui';
        }else{
            echo 'Izin Di tolak';
            echo $sql;
        }
        mysqli_close($con);
    }
?>