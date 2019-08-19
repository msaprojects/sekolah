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

// 	$cekpakai = mysqli_query($con, "SELECT * FROM pengguna where id_biodata=$idbiodata and aktif = 0");
	$cekpakai = mysqli_query($con, "SELECT * FROM pengguna where id_biodata=$idbiodata");
// 	$hasilpengecekan = mysqli_fetch_array($cekpakai);
// 	if(!empty($hasilpengecekan)){

		$query = mysqli_query($con, "SELECT p.*, j.nama as jabatan, s.nama, pg.nama as pgnama, pg.foto as pgfoto, s.foto, k.idkelas, k.level_kelas FROM pengguna p, jabatan j, siswa s, pegawai pg, kelas_detail kd, kelas k WHERE p.idjabatan=j.idjabatan AND s.nis=kd.nis AND k.idkelas=kd.idkelas AND (s.nis=p.id_biodata OR pg.nip=p.id_biodata) AND id_biodata='$idbiodata' AND password='$password' limit 1;");

		$row = mysqli_fetch_array($query);
	
		if (!empty($row)){
			$response = new usr();
			$response->success = 1;
			$response->idpengguna = $row['idpengguna'];
			$response->nama = $row['nama'];
			$response->pgnama = $row['pgnama'];
			$response->foto = $row['foto'];
			$response->pgfoto = $row['pgfoto'];
			$response->password = $row['password'];
			$response->idbiodata = $row['id_biodata'];
			$response->jabatan = $row['jabatan'];
			$response->idkelas = $row['idkelas'];
			$response->level_kelas = $row['level_kelas'];
			die(json_encode($response));
		} else { 
			$response = new usr();
			$response->success = 0;
			$response->message = "Nis atau Password salah!";
			die(json_encode($response));
		}
		mysqli_close($con);
// 	}else{
// 		$response = new usr();
// 			$response->success = 0;
// 			$response->message = "User Ini Sudah di pakai di device lain!!, Harap Logout Terlebih Dahulu";
// 			die(json_encode($response));
// 		// echo "User Ini Sudah di pakai di device lain!!, Harap Logout Terlebih Dahulu";
// 		mysqli_close($con);
// 	}    
	mysqli_close($con);

?>