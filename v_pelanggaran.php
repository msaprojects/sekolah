<?php 

    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];
    
    if($jabatan == "Siswa"){
        $idbiodata = $_GET['idbiodata'];
        $sql = "SELECT p.*, s.nama, kp.jenis_pelanggaran FROM pelanggaran p, kat_pelanggaran kp, siswa s where p.idkat_pelanggaran=kp.idkat_pelanggaran and s.nis=p.nis and p.nis=$idbiodata;";
    }else{
        $sql = "SELECT p.*, s.nama, kp.jenis_pelanggaran FROM pelanggaran p, kat_pelanggaran kp, siswa s where p.idkat_pelanggaran=kp.idkat_pelanggaran and s.nis=p.nis;";
    }

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idpelanggaran"=>$row['idpelanggaran'],
            "nis"=>$row['nis'],
            "nama"=>$row['nama'],
            "jenis"=>$row['jenis_pelanggaran'],
            "keterangan"=>$row['keterangan'],
            "point"=>$row['point'],
            "tindakan"=>$row['tindakan'],
            "tanggal" => $row['tanggal']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>