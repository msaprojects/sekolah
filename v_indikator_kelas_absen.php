<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');
    
    $sql = "SELECT count(nis) as jumlah_siswa, kelas_detail.idkelas as idkelas_siswa, k.level_kelas, ifnull((SELECT count(nis) as jumlah_absen from absensi_bk abk where tanggal=curdate() and kelas_detail.idkelas=abk.idkelas  group by idkelas order by abk.idkelas),0) as jumlah_siswa_diabsen from kelas_detail, kelas k where k.idkelas=kelas_detail.idkelas group by kelas_detail.idkelas order by kelas_detail.idkelas;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result, array(
            "jumlah_siswa"=>$row['jumlah_siswa'],
            "idkelas_siswa"=>$row['idkelas_siswa'],
            "level_kelas"=>$row['level_kelas'],
            "jumlah_siswa_diabsen"=>$row['jumlah_siswa_diabsen'],
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>