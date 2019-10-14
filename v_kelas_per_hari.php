<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $idbiodata=$_GET['idbiodata'];
    $idhari=$_GET['idhari'];
    
    $sql = "SELECT jp.idjadwal_pelajaran, jp.idmata_pelajaran, jp.idth_ajaran, jp.idhari, k.level_kelas, k.idkelas from jadwal_pelajaran jp, kelas k where k.idkelas = jp.idkelas and jp.idhari='$idhari' and nip='$idbiodata' group by jp.idkelas;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idjadwal_pelajaran"=>$row['idjadwal_pelajaran'],
            "idmata_pelajaran"=>$row['idmata_pelajaran'],
            "idth_ajaran"=>$row['idth_ajaran'],
            "idhari"=>$row['idhari'],
            "level_kelas"=>$row['level_kelas'],
            "idkelas"=>$row['idkelas']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>