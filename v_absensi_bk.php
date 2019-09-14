<?php 
header('Content-Type: charset=utf-8');
date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];
    $selainmasuk = 'selainmasuk';
    
    if(isset($_POST['filter'])){
        $filter = $_POST['filter'];
        if($filter=="minggu"){
            $vfilter = " and yearweek(abk.tanggal)=yearweek(now()) ";
        }else if($filter=="bulan"){
             $vfilter = " and month(abk.tanggal)=month(current_date()) ";
        }else if($filter=="semester"){
            
        }else if($filter=="search"){
            
        }
    }else{
        $vfilter= "";
    }

    if($jabatan=="Siswa" || $jabatan=="siswa" || $selainmasuk==""){
        $idbiodata = $_GET['idbiodata'];
        $sql = "SELECT s.nama, k.level_kelas as kelas, abk.nis, abk.jam, abk.tanggal, abk.keterangan FROM absensi_bk abk, siswa s, kelas k, kelas_detail kd where abk.nis=s.nis and kd.nis=s.nis and kd.idkelas=k.idkelas and abk.nis=$idbiodata Order By abk.idabsensi_bk DESC";
    }
    elseif($jabatan=="BK" || $jabatan=="Pegawai" || $jabatan=="Akademik" || $selainmasuk!=""){
        $kelas = $_GET['idkelas'];
        $sql = "SELECT s.nama, k.level_kelas as kelas, abk.nis, abk.jam, abk.tanggal, abk.keterangan FROM absensi_bk abk, siswa s, kelas k, kelas_detail kd where abk.nis=s.nis and kd.nis=s.nis and kd.idkelas=k.idkelas and abk.keterangan!='masuk' and abk.tanggal = CURDATE() and k.idkelas=$kelas Order By abk.tanggal DESC";
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