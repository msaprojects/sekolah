<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];

    if($jabatan == 'Siswa' || $jabatan == 'Wali'){
        $idbiodata = $_GET['idbiodata'];
        $sql = "SELECT * FROM pembayaran p, pembayaran_detail pd where p.idpembayaran=pd.idpembayaran and nis='$idbiodata' group by p.idpembayaran;";
    }else{
        $sql = "SELECT * FROM pembayaran p, pembayaran_detail pd where p.idpembayaran=pd.idpembayaran and p.tanggal_bayar=month(tanggal_bayar) group by p.idpembayaran;";
    }

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "idpembayaran"=>$row['idpembayaran'],
            "no"=>$row['no'],   
            "tanggal_bayar"=>$row['tanggal_bayar'],
            "total"=>$row['total'],
            "keterangan"=>$row['keterangan'],
            "nis"=>$row['nis']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>