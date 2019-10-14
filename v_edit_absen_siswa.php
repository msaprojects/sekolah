<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $idkelas=$_GET['idkelas'];
    // $idkelas = 1;
    
    $sql = "SELECT abk.nis, abk.keterangan, s.nama, k.level_kelas, abk.idkelas FROM absensi_bk abk, siswa s, kelas k where abk.nis=s.nis and abk.idkelas=k.idkelas and abk.tanggal=curdate() and abk.idkelas=$idkelas;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "nis"=>$row['nis'],
            "nama"=>$row['nama'],
            "level_kelas"=>$row['level_kelas'],
            "keterangan"=>$row['keterangan'],
            "idkelas"=>$row['idkelas']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>