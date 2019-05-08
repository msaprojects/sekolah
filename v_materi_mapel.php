<?php 

    require_once('koneksi.php');
    
    $idmata_pelajaran = $_GET['idmata_pelajaran'];
    $idjadwal_pelajaran = $_GET['idjadwal_pelajaran'];

    $sql = "SELECT m.* FROM materi m, jadwal_pelajaran jp WHERE weekofyear(m.tanggal) and jp.idmata_pelajaran=$idmata_pelajaran and m.idjadwal_pelajaran=$idjadwal_pelajaran GROUP BY month(m.tanggal);";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "tanggal"=>$row['tanggal'],
            "judul"=>$row['judul'],
            "materi"=>$row['materi'],
            "tugas"=>$row['tugas'],
            "keterangan"=>$row['keterangan']            
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>