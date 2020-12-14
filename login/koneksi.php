<?php
	/* ===== www.dedykuncoro.com ===== */
	$server		= "localhost"; //sesuaikan dengan nama server
	$user		= "root"; //sesuaikan username
	$password	= ""; //sesuaikan password
	$database	= "ebook2"; //sesuaikan target databese
	
	// $connect = mysql_connect($server, $user, $password, $database);
	$connect = new mysqli($server, $user, $password, $database); 
	// var_dump($connect);
	// die;
	// or die ("Koneksi gagal!");
	// mysql_select_db($database) or die ("Database belum siap!");

	// /* ====== UNTUK MENGGUNAKAN MYSQLI DI UNREMARK YANG INI, YANG MYSQL_CONNECT DI REMARK ======= */
	// // $con = mysqli_connect($server, $user, $password, $database);
	// // if (mysqli_connect_errno()) {
	// // 	echo "Gagal terhubung MySQL: " . mysqli_connect_error();
	// // }

?>