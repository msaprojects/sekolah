<?php 
header('Content-Type: charset=utf-8');
    require_once('koneksi.php');

    // $idbiodata = $_GET['idbiodata'];
    $idhari = $_GET['idhari'];
    $idkelas = $_GET['idkelas'];
    
    // $sql = "SELECT j.jam_ke, j.jam_awal, j.jam_akhir, k.level_kelas, mp.mapel, h.hari, p.nama as namaguru, jp.idjadwal_pelajaran, mp.idmata_pelajaran FROM jadwal_pelajaran jp, mata_pelajaran mp, hari h, kelas k, jam j, kelas_detail kd, pegawai p WHERE jp.nip=p.nip AND jp.idmata_pelajaran=mp.idmata_pelajaran AND h.idhari=jp.idhari AND jp.idkelas=k.idkelas AND j.idjam=jp.idjam AND kd.idkelas=k.idkelas AND kd.nis='$idbiodata' AND h.idhari=$hari ORDER BY k.level_kelas;";
    $sql = "SELECT jp.idjadwal_pelajaran, jp.idmata_pelajaran, mp.mapel, p.nama, h.hari, j.jam_ke, j.jam_awal, j.jam_akhir, k.level_kelas FROM jadwal_pelajaran jp, mata_pelajaran mp, hari h, jam j, kelas k, semester s, th_ajaran ta, pegawai p WHERE jp.idmata_pelajaran=mp.idmata_pelajaran and jp.idth_ajaran=ta.idth_ajaran and jp.idhari=h.idhari and j.idjam=jp.idjam and jp.nip=p.nip and jp.idkelas=k.idkelas and jp.idsemester=s.idsemester and h.idhari='".$idhari."' and k.idkelas='".$idkelas."'";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idjadwal_pelajaran"=>$row['idjadwal_pelajaran'],
            "idmata_pelajaran"=>$row['idmata_pelajaran'],
            "mapel"=>$row['mapel'],
            "namaguru"=>$row['nama'],
            "hari"=>$row['hari'],
            "jam_ke"=>$row['jam_ke'],
            "jam_awal"=>$row['jam_awal'],
            "jam_akhir"=>$row['jam_akhir'],
            "kelas"=>$row['level_kelas']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>