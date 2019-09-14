<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');
    
    $sql = "SELECT * FROM kelas k, kelas_detail kd WHERE k.idkelas=kd.idkelas group by level_kelas order by kd.idkelas;";
   
    $r = mysqli_query($con, $sql);
   
    $result = array();
   
    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idkelas"=>$row['idkelas'],
            "level_kelas"=>$row['level_kelas'],
            "tingkat_kelas"=>$row['tingkat_kelas'],
            "keterangan"=>$row['keterangan'],
            "idjurusan"=>$row['idjurusan']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>