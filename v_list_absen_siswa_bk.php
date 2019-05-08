<?php 
header('Content-Type: charset=utf-8');
    require_once('koneksi.php');
    
    $kelas = $_GET['idkelas'];
    
    // $cek = "select * from absensi_bk abk, kelas_detail kd where abk.nis=kd.nis and kd.idkelas=$kelas and abk.tanggal=date(now());";
    // $recordcount = mysqli_query($con, $cek);
    // $result = array();
    // if(mysqli_num_rows($recordcount)!=0){
    //     array_push($result, array(
    //         "nis"=>"0",
    //         "nama"=>"",
    //         "level_kelas"=>"",
    //         "tingkat_kelas"=>"",
    //         ));
    //         echo json_encode(array('result'=>$result));
    //         mysqli_close($con);
    //     // echo 'Hari ini siswa telah di absen '.$cek;
    
    // }else{
        
        // $sql = "SELECT s.nis, s.nama, k.level_kelas, k.tingkat_kelas FROM siswa s,kelas k, kelas_detail kd WHERE s.nis=kd.nis AND k.idkelas=kd.idkelas  AND s.kelas=k.tingkat_kelas AND k.idkelas=$kelas and not in (select * from absensi_bk where tanggal=now()));";
        $sql = "SELECT s.nis, s.nama, k.level_kelas, k.tingkat_kelas FROM siswa s,kelas k, kelas_detail kd WHERE s.nis=kd.nis AND k.idkelas=kd.idkelas  AND s.kelas=k.tingkat_kelas AND k.idkelas=2 and s.nis not in (select nis from absensi_bk where tanggal=date(now()));";
    
        $r = mysqli_query($con, $sql);
    
        $result = array();
        if(mysqli_num_rows($r)!=0){
            while($row = mysqli_fetch_array($r)){
                array_push($result,array(
                    "nis"=>$row['nis'],
                    "nama"=>$row['nama'],
                    "level_kelas"=>$row['level_kelas'],
                    "tingkat_kelas"=>$row['tingkat_kelas']
                ));
            }
        }else{
            array_push($result, array(
            "nis"=>"0",
            "nama"=>"",
            "level_kelas"=>"",
            "tingkat_kelas"=>"",
            ));
            echo json_encode(array('result'=>$result));
            mysqli_close($con);
        }
    
        echo json_encode(array('result'=>$result));
        mysqli_close($con);
            
    // }
?>