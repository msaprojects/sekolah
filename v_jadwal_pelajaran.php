<?php 
header('Content-Type: charset=utf-8');
    require_once('koneksi.php');

    $idbiodata = $_GET['idbiodata'];
    $hari = $_GET['idhari'];
    
    $sql = "SELECT j.jam_ke, j.jam_awal, j.jam_akhir, k.level_kelas, mp.mapel, h.hari, p.nama as namaguru FROM jadwal_pelajaran jp, mata_pelajaran mp, hari h, kelas k, jam j, kelas_detail kd, pegawai p WHERE jp.nip=p.nip AND jp.idmata_pelajaran=mp.idmata_pelajaran AND h.idhari=jp.idhari AND jp.idkelas=k.idkelas AND j.idjam=jp.idjam AND kd.idkelas=k.idkelas AND kd.nis='$idbiodata' AND h.idhari=$hari ORDER BY k.level_kelas;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "jam_ke"=>$row['jam_ke'],
            "jam_awal"=>$row['jam_awal'],
            "jam_akhir"=>$row['jam_akhir'],
            "kelas"=>$row['level_kelas'],
            "mapel"=>$row['mapel'],
            "hari"=>$row['hari'],
            "namaguru"=>$row['namaguru']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>