<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $nip = $_GET['nip'];
    
    $sql = "SELECT ds.nis, ds.nama, k.level_kelas, k.tingkat_kelas FROM data_siswa ds,kelas k, kelas_detail kd WHERE ds.nis=kd.nis AND k.idkelas=kd.idkelas  AND ds.kelas=k.tingkat_kelas AND k.idkelas=$kelas;";

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