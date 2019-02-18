<?php

	 define('HOST','127.0.0.1');
	 define('USER','root');
	 define('PASS','');
	 define('DB','eschool');

	 $con = mysqli_connect(HOST,USER,PASS,DB) or die ('gagal konek ke database');
     
?>