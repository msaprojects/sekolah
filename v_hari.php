<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');
    
    $sql = "SELECT * FROM hari;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idhari"=>$row['idhari'],
            "hari"=>$row['hari']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>