<?php 

    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];
    // $idbiodata = 2016420031;

    if($jabatan=="Siswa" || $jabatan=="siswa"){
        $idbiodata = $_GET['idbiodata'];
        $sql = "SELECT s.nama, k.level_kelas as kelas, abk.nis, abk.jam, abk.tanggal, abk.keterangan FROM absensi_bk abk, siswa s, kelas k, kelas_detail kd where abk.nis=s.nis and kd.nis=s.nis and kd.idkelas=k.idkelas and abk.nis=$idbiodata;";
    }elseif($jabatan=="BK" || $jabatan=="Pegawai" || $jabatan=="Akademik"){
        $sql = "SELECT s.nama, k.level_kelas as kelas, abk.nis, abk.jam, abk.tanggal, abk.keterangan FROM absensi_bk abk, siswa s, kelas k, kelas_detail kd where abk.nis=s.nis and kd.nis=s.nis and kd.idkelas=k.idkelas;";
    }
    
    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "nama"=>$row['nama'],
            "nis"=>$row['nis'],
            "jam"=>$row['jam'],
            "tanggal"=>$row['tanggal'],
            "kelas"=>$row['kelas'],
            "keterangan"=>$row['keterangan']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>