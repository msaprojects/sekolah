<?php
    require_once ('koneksi.php');

    class usr{}

	$username = $_POST["email"];
	$password = $_POST["password"];

	if ((empty($username)) || (empty($password))) { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom tidak boleh kosong"; 
		die(json_encode($response));
	}

	$query = mysqli_query($con, "SELECT p.*, j.nama as jabatan FROM pengguna p, jabatan j WHERE p.idjabatan=j.idjabatan AND username='$username' AND password='$password'");

	$row = mysqli_fetch_array($query);

	if (!empty($row)){
		$response = new usr();
		$response->success = 1;
		$response->idpengguna = $row['idpengguna'];
        $response->email = $row['username'];
		$response->password = $row['password'];
		$response->idbiodata = $row['id_biodata'];
		$response->jabatan = $row['jabatan'];
		die(json_encode($response));
	} else { 
		$response = new usr();
		$response->success = 0;
		$response->message = "username atau password salah";
		die(json_encode($response));
    }
    
	mysqli_close($con);

?>