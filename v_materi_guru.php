<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');
    
    $idbiodata = $_GET['idbiodata'];

    $sql = "SELECT m.idmateri, m.tanggal, m.judul, m.materi, m.tugas, m.judul_tugas, m.tgl_akhir_tugas, jp.idjadwal_pelajaran, jp.nip, mp.kode, mp.mapel, h.hari, j.jam_awal, j.jam_akhir, k.level_kelas from materi m, jadwal_pelajaran jp, hari h, jam j, kelas k, mata_pelajaran mp where mp.idmata_pelajaran=jp.idmata_pelajaran and m.idjadwal_pelajaran=jp.idjadwal_pelajaran and jp.idhari=h.idhari and jp.idjam=j.idjam  and jp.idkelas=k.idkelas and nip='$idbiodata' and yearweek(m.tanggal)=yearweek(curdate());";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idmateri"=>$row['idmateri'],
            "tanggal"=>$row['tanggal'],
            "judul"=>$row['judul'],
            "materi"=>$row['materi'],
            "tugas"=>$row['tugas'],
            "judul_tugas"=>$row['judul_tugas'],
            "tgl_akhir_tugas"=>$row['tgl_akhir_tugas'],
            "idjadwal_pelajaran"=>$row['idjadwal_pelajaran'],
            "nip"=>$row['nip'],
            "kode"=>$row['kode'],
            "mapel"=>$row['mapel'],
            "hari"=>$row['hari'],
            "level_kelas"=>$row['level_kelas']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>