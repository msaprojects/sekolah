<?php 
  
    require_once('koneksi.php');

    $jabatan = $_GET['jabatan'];
    // $nip = $_GET['nip'];
    if($jabatan=="Siswa"){
        
        $nis=$_GET['nis'];
        $sql = "SELECT * from siswa where nis=".$nis;

        $r = mysqli_query($con, $sql);
        $result = array();
        
        while($row = mysqli_fetch_array($r)){
            array_push($result, array(
                "nis"=>$row['nis'],
                "nisn"=>$row['nisn'],
                "nama"=>$row['nama'],
                "tempat_lahir"=>$row['tempat_lahir'],
                "tgl_lahir"=>$row['tgl_lahir'],
                "alamat"=>$row['alamat'],
                "idkota"=>$row['idkota'],
                "email"=>$row['email'],
                "foto"=>$row['foto'],
                "idagama"=>$row['idagama'],
                "idjabatan"=>$row['idjabatan'],
                "idjenis_kelamin"=>$row['idjenis_kelamin'],
                "tahun"=>$row['tahun'],
                "aktif"=>$row['aktif'],
                "kelas"=>$row['kelas'],
                "idpengguna"=>$row['idpengguna']
            ));
        }

    }else{
        $nip = $_GET['nip'];

        $sql = "SELECT * FROM pegawai  WHERE nip=".$nip;
    
        $r = mysqli_query($con, $sql);
        $result = array();
        
        while($row = mysqli_fetch_array($r)){
            array_push($result, array(
                "nip"=>$row['nip'],
                "nik"=>$row['nik'],
                "nama"=>$row['nama'],
                "alamat"=>$row['alamat'],
                "idkota"=>$row['idkota'],
                "email"=>$row['email'],
                "foto"=>$row['foto'],
                "tgl_lahir"=>$row['tgl_lahir'],
                "tempat_lahir"=>$row['tempat_lahir'],
                "th_masuk"=>$row['th_masuk'],
                "pendidikan_akhir"=>$row['pendidikan_akhir'],
                "studi"=>$row['studi'],
                "idagama"=>$row['idagama'],
                "idjabatan"=>$row['idjabatan'],
                "idjenis_kelamin"=>$row['idjenis_kelamin'],
                "aktif"=>$row['aktif'],
                "keterangan"=>$row['keterangan'],
                "idpengguna"=>$row['idpengguna']
            ));
        }
    
    }

    echo json_encode(array('result'=>$result));
    mysqli_close($con);

?>

