<?php
    require_once ("koneksi.php");
    $query = mysqli_query($con, "SELECT * from kat_informasi");
    $json = array();
    while($row = mysqli_fetch_assoc($query)){
        $json[] = $row;
    }
    echo json_encode(array('result'=>$json));
    mysqli_close($con);
?>