<?php 
    header('Content-Type: charset=utf-8');
    date_default_timezone_set('Asia/Jakarta');
    require_once('koneksi.php');

        $sql = "SELECT wk.nip, k.level_kelas, nt.nomor, p.nama, p.foto FROM wali_kelas wk, notelp nt, kelas k, pegawai p where wk.nip=nt.nip and wk.idkelas=k.idkelas and wk.nip=p.nip";

        $r = mysqli_query($con, $sql);

        $result = array();

        while($row = mysqli_fetch_array($r)){
            array_push($result,array(
                "nip"=>$row['nip'],
                "level_kelas" => $row['level_kelas'],
                "nomor" => $row['nomor'],
                "nama" => $row['nama'],
                "foto" => $row['foto']
            ));
        }

        echo json_encode(array('result'=>$result));
        mysqli_close($con);

?>