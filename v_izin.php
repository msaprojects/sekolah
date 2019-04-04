<?php 

    require_once('koneksi.php');

    $idbiodata = $_GET['idbiodata'];
    $jabatan = $_GET['jabatan'];

    if($jabatan == 'Siswa'){
        $sql = "SELECT ik.*, s.nama as nama, k.tingkat_kelas as kelas  FROM izin_kelas ik, siswa s, kelas_detail kd, kelas k where ik.nis=s.nis and s.nis=kd.nis and kd.idkelas=k.idkelas and s.nis=$idbiodata;";
    }else{
        $sql = "SELECT ik.*, s.nama as nama, k.tingkat_kelas as kelas  FROM izin_kelas ik, siswa s, kelas_detail kd, kelas k where ik.nis=s.nis and s.nis=kd.nis and kd.idkelas=k.idkelas;";
    }

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idizin"=>$row['idizin_kelas'],
            "alasan"=>$row['alasan'],
            "tanggal"=>$row['tanggal'],
            "kategori"=>$row['kategori'],
            "approve"=>$row['approve'],
            "nis"=>$row['nis'],
            "gambar"=>$row['gambar'],
            "nama"=>$row['nama'],
            "kelas"=>$row['kelas']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>