<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $idbiodata = $_GET['idbiodata'];
    $jabatan = $_GET['jabatan'];

    if($jabatan == 'Siswa'){
        $sql = "SELECT ik.*, s.nama as nama, k.tingkat_kelas as kelas  FROM izin_kelas ik, siswa s, kelas_detail kd, kelas k where ik.nis=s.nis and s.nis=kd.nis and kd.idkelas=k.idkelas and s.nis=$idbiodata order by ik.timestamp DESC";
    }else{
        $sql = "SELECT ik.*, s.nama as nama, k.tingkat_kelas as kelas  FROM izin_kelas ik, siswa s, kelas_detail kd, kelas k where ik.nis=s.nis and s.nis=kd.nis and kd.idkelas=k.idkelas order by ik.timestamp DESC;";
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