<?php 

    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];
    
    if($jabatan == "Siswa"){
        $idbiodata = $_GET['idbiodata'];
        $sql = "SELECT p.*, s.nama as siswa, pp.*, kp.jenis_pelanggaran FROM pelanggaran p, point_pelanggaran pp, kat_pelanggaran kp, siswa s where p.idpoint_pelanggaran=pp.idpoint_pelanggaran and pp.idkat_pelanggaran=kp.idkat_pelanggaran and s.nis=p.nis and p.nis=$idbiodata;";
    }else{
        $sql = "SELECT p.*, s.nama as siswa, pp.*, kp.jenis_pelanggaran FROM pelanggaran p, point_pelanggaran pp, kat_pelanggaran kp, siswa s where p.idpoint_pelanggaran=pp.idpoint_pelanggaran and pp.idkat_pelanggaran=kp.idkat_pelanggaran and s.nis=p.nis and p.tanggal=date(now());";
    }

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idpelanggaran"=>$row['idpelanggaran'],
            "nis"=>$row['nis'],
            "nama"=>$row['siswa'],
            "pelanggaran"=>$row['nama'],
            "keterangan"=>$row['keterangan'],
            "point"=>$row['point'],
            "tindakan"=>$row['tindakan'],
            "tanggal" => $row['tanggal']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>