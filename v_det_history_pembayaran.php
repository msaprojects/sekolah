<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];
    $idpembayaran = $_GET['idpembayaran'];

    if($jabatan == 'Siswa' || $jabatan == 'Wali'){
        $sql = "SELECT pd.nominal, pd.keterangan from pembayaran p, pembayaran_detail pd where p.idpembayaran=pd.idpembayaran and pd.idpembayaran='$idpembayaran';";
    }else{
        $sql = "SELECT pd.nominal, pd.keterangan from pembayaran p, pembayaran_detail pd where p.idpembayaran=pd.idpembayaran and pd.idpembayaran='$idpembayaran';";
    }

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "nominal"=>$row['nominal'],
            "keterangan"=>$row['keterangan']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>