<?php 

    require_once('koneksi.php');
    
    $sql = "SELECT * FROM about order by idabout DESC;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idabout"=>$row['idabout'],
            "judul"=>$row['judul'],
            "keterangan"=>$row['keterangan']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>