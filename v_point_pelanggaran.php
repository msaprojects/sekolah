<?php 

    require_once('koneksi.php');
    
    $idkatpelanggaran = $_GET['idkat_pelanggaran'];

    $sql = "SELECT pp.*, kp.jenis_pelanggaran as kategori FROM point_pelanggaran pp, kat_pelanggaran kp where pp.idkat_pelanggaran=kp.idkat_pelanggaran and pp.idkat_pelanggaran=$idkatpelanggaran;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idpoint_pelanggaran"=>$row['idpoint_pelanggaran'],
            "nama"=>$row['nama'],
            "point"=>$row['point'],
            "tindakan"=>$row['tindakan'],
            "idkat_pelanggaran"=>$row['idkat_pelanggaran'],
            "kategori"=>$row['kategori']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>