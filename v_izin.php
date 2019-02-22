<?php 

    require_once('koneksi.php');
    
    $sql = "SELECT ik.*, ds.nama as namasiswa, k.tingkat_kelas as kelas  FROM izin_kelas ik, data_siswa ds, kelas_detail kd, kelas k where ik.nis=ds.nis and ds.nis=kd.nis and kd.idkelas=k.idkelas;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idizin_kelas"=>$row['idizin_kelas'],
            "alasan"=>$row['alasan'],
            "tanggal"=>$row['tanggal'],
            "kategori"=>$row['kategori'],
            "approve"=>$row['approve'],
            "nis"=>$row['nis'],
            "gambar"=>$row['gambar'],
            "namasiswa"=>$row['namasiswa'],
            "kelas"=>$row['kelas']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>