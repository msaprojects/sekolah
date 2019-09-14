<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');
    
    $sql = "SELECT * FROM kat_pelanggaran;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idkat_pelanggaran"=>$row['idkat_pelanggaran'],
            "kategori"=>$row['jenis_pelanggaran']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>