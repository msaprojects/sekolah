<?php 

    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];

    if($jabatan == 'Siswa' || $jabatan == 'Wali'){
        $idbiodata = $_GET['idbiodata'];
        $sql = "SELECT * FROM pembayaran p, pembayaran_detail pd where p.idpembayaran=pd.idpembayaran and nis='$idbiodata';";
    }else{
        $sql = "SELECT * FROM pembayaran p, pembayaran_detail pd where p.idpembayaran=pd.idpembayaran;";
    }

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idpembayaran"=>$row['idpembayaran'],
            "no"=>$row['no'],
            "tanggal_bayar"=>$row['tanggal_bayar'],
            "bulan"=>$row['bulan'],
            "nis"=>$row['nis'],
            "nominal"=>$row['nominal'],
            "nominal_lain"=>$row['nominal_lain'],
            "total"=>$row['total'],
            "timestamp"=>$row['timestamp']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>