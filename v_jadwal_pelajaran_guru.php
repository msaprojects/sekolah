<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $idbiodata=$_GET['idbiodata'];
    $idkelas=$_GET['idkelas'];
    
    $sql = "select jp.idjadwal_pelajaran, mp.mapel, jp.idjam, j.jam_ke, j.jam_awal, j.jam_akhir, jp.idkelas from jadwal_pelajaran jp, mata_pelajaran mp, th_ajaran ta, jam j where jp.idmata_pelajaran=mp.idmata_pelajaran and ta.idth_ajaran=jp.idth_ajaran and j.idjam=jp.idjam and idkelas='$idkelas' and nip='$idbiodata' order by jp.idjam;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idjadwal_pelajaran"=>$row['idjadwal_pelajaran'],
            "idkelas"=>$row['idkelas'],
            "mapel"=>$row['mapel'],
            "jam_ke"=>$row['jam_ke'],
            "jam_awal"=>$row['jam_awal'],
            "jam_akhir"=>$row['jam_akhir']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>