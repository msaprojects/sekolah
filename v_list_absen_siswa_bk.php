<?php 
header('Content-Type: charset=utf-8');
    require_once('koneksi.php');
    $kelas = $_GET['idkelas'];
    
    $sql = "SELECT s.nis, s.nama, k.level_kelas, k.tingkat_kelas FROM siswa s,kelas k, kelas_detail kd WHERE s.nis=kd.nis AND k.idkelas=kd.idkelas  AND s.kelas=k.tingkat_kelas AND k.idkelas=$kelas;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "nis"=>$row['nis'],
            "nama"=>$row['nama'],
            "level_kelas"=>$row['level_kelas'],
            "tingkat_kelas"=>$row['tingkat_kelas']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>