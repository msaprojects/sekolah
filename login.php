<?php
    require_once ('koneksi.php');

    class usr{}

	$idbiodata = $_POST["idbiodata"];
	$password = $_POST["password"];

	if ((empty($idbiodata)) || (empty($password))) { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom tidak boleh kosong"; 
		$response->biodata = $idbiodata;
		$response->password = $password;
		die(json_encode($response));
	}

	$query = mysqli_query($con, "SELECT p.*, j.nama as jabatan, s.nama, pg.nama as pgnama FROM pengguna p, jabatan j, siswa s, pegawai pg WHERE p.idjabatan=j.idjabatan AND (s.nis=p.id_biodata OR pg.nip=p.id_biodata) AND id_biodata='$idbiodata' AND password='$password' limit 1;");

	$row = mysqli_fetch_array($query);

	if (!empty($row)){
		$response = new usr();
		$response->success = 1;
		$response->idpengguna = $row['idpengguna'];
        $response->nama = $row['nama'];
        $response->pgnama = $row['pgnama'];
		$response->password = $row['password'];
		$response->idbiodata = $row['id_biodata'];
		$response->jabatan = $row['jabatan'];
		die(json_encode($response));
	} else { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Nis atau Password salah!";
		die(json_encode($response));
    }
    
	mysqli_close($con);

?>