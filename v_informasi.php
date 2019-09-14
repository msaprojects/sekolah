<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');
    
    $sql = "SELECT * FROM informasi order by idinformasi DESC;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idinformasi"=>$row['idinformasi'],
            "judul"=>$row['judul'],
            "deskripsi"=>$row['deskripsi'],
            "gambar"=>$row['gambar'],
            "idkat_informasi"=>$row['idkat_informasi'],
            "timestamp"=>$row['timestamp']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>