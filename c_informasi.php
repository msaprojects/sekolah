<?php 
	require_once('koneksi.php');

    $keyword = $_GET['keyword'];
    // $keyword = 'hari';

	$query = mysqli_query($con, "SELECT * FROM informasi WHERE judul LIKE '%".$keyword."%' or deskripsi LIKE '%".$keyword."%'");

	$num_rows = mysqli_num_rows($query);

	if ($num_rows > 0){
		$json = '{"value":1, "results": [';

		while ($row = mysqli_fetch_array($query)){
			$char ='"';

			$json .= '{
				"idinformasi": "'.str_replace($char,'`',strip_tags($row['idinformasi'])).'",
                "judul": "'.str_replace($char,'`',strip_tags($row['judul'])).'",
                "deskripsi": "'.str_replace($char,'`',strip_tags($row['deskripsi'])).'"
			},';
		}

		$json = substr($json,0,strlen($json)-1);

		$json .= ']}';

	} else {
		$json = '{"value":0, "message": "Data tidak ditemukan."}';
	}

	echo $json;

	mysqli_close($con);
?>