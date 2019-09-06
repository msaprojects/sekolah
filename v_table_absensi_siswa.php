<?php 

    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];

    if($jabatan != 'Siswa' || $jabatan != 'Wali'){
        $idkelas = $_GET['idkelas'];
        $sql = "SELECT absensi_bk.nis, s.nama, 
        count(case when keterangan='masuk' then keterangan else null end) as masuk, 
        count(case when keterangan='tidak masuk' then keterangan else null end) as alpa, 
        count(case when keterangan='sakit' then keterangan else null end) as sakit, 
        count(case when keterangan='izin' then keterangan else null end) as izin from absensi_bk, siswa s where absensi_bk.nis=s.nis and absensi_bk.idkelas=$idkelas group by nis;";

        $r = mysqli_query($con, $sql);

        $result = array();

        while($row = mysqli_fetch_array($r)){
            array_push($result,array(
                "nis"=>$row['nis'],
                "nama"=>$row['nama'],
                "masuk"=>$row['masuk'],
                "alpa"=>$row['alpa'],
                "sakit"=>$row['sakit'],
                "izin"=>$row['izin']
            ));
        }

        echo json_encode(array('result'=>$result));
        mysqli_close($con);

    }else{
            mysqli_close($con);
    }

?>