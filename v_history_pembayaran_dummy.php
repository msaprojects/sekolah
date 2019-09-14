<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];

    if($jabatan == 'Siswa' || $jabatan == 'Wali'){
        $idbiodata = $_GET['idbiodata'];
        $sql = "SELECT * FROM pembayaran p where nis='$idbiodata' order by idpembayaran desc;";
    }else{
        $sql = "SELECT * FROM pembayaran;";
    }

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idpembayaran"=>$row['idpembayaran'],
            "no"=>$row['no'],
            "tanggal_bayar"=>$row['tanggal_bayar'],
            "keterangan"=>$row['keterangan'],
            "nis"=>$row['nis'],
            "nominal"=>$row['nominal']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>