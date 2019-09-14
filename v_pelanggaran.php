<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];
    
    if($jabatan == "Siswa"){
        $idbiodata = $_GET['idbiodata'];
        $sql = "SELECT p.*, s.nama as siswa, pp.*, kp.jenis_pelanggaran FROM pelanggaran p, point_pelanggaran pp, kat_pelanggaran kp, siswa s where p.idpoint_pelanggaran=pp.idpoint_pelanggaran and pp.idkat_pelanggaran=kp.idkat_pelanggaran and s.nis=p.nis and p.nis=$idbiodata;";
    }else{
        $idkelas = $_GET['idkelas'];
       $sql = "SELECT p.*, s.nama as siswa, k.*, pp.*, kp.jenis_pelanggaran FROM pelanggaran p, point_pelanggaran pp, kat_pelanggaran kp, siswa s, kelas k, kelas_detail kd where p.idpoint_pelanggaran=pp.idpoint_pelanggaran and pp.idkat_pelanggaran=kp.idkat_pelanggaran and s.nis=p.nis and MONTH(p.tanggal) and s.nis=kd.nis and k.idkelas=kd.idkelas and k.idkelas=$idkelas;";
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