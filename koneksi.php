<?php

	 define('HOST','127.0.0.1');
	 define('USER','root');
	 define('PASS','root1');
	 define('DB','sekolah_sunangiri');

	 $con = mysqli_connect(HOST,USER,PASS,DB) or die ('gagal konek ke database');
     
?>