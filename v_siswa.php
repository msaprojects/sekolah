<?php 
    require_once('koneksi.php');

        $idkelas = $_GET['idkelas'];
        $sql = "SELECT s.nis, s.nisn, s.nama, s.tempat_lahir, s.tgl_lahir, k.tingkat_kelas, k.level_kelas, j.nama as jurusan  from siswa s, kelas k, kelas_detail kd, jurusan j where s.nis=kd.nis and k.idjurusan=j.idjurusan and kd.idkelas=k.idkelas and k.idkelas=$idkelas";

        $r = mysqli_query($con, $sql);

        $result = array();

        while($row = mysqli_fetch_array($r)){
            array_push($result,array(
                "nis"=>$row['nis'],
                "nama"=>$row['nama'],
                "level_kelas" => $row['level_kelas'],
                "tingkat_kelas" => $row['tingkat_kelas'],
                "jurusan" => $row['jurusan']
            ));
        }

        echo json_encode(array('result'=>$result));
        mysqli_close($con);

?>