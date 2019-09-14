<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');
    
    $sql = "SELECT * FROM pegawai p, notelp nt where p.nip=nt.nip group by p.nip;";

    $r = mysqli_query($con, $sql);

    $result = array();

    while($row = mysqli_fetch_array($r)){
        array_push($result,array(
            "nip"=>$row['nip'],
            "nama"=>$row['nama'],
            "alamat"=>$row['alamat'],
            "nomor"=>$row['nomor'],
            "gambar"=>$row['foto']
        ));
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);
?>