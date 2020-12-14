<?php
/* ===== www.dedykuncoro.com ===== */
include 'koneksi.php';
	
	class usr{}
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$radio = $_POST["radio"];
	$pendidikan = $_POST["pendidikan"];
	$minat = $_POST["minat"];
	$nama = $_POST["nama"];
	$pekerjaan = $_POST["pekerjaan"]; 
	$confirm_password = $_POST["confirm_password"];
	
	if ((empty($username))) { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom username tidak boleh kosong"; 
		die(json_encode($response));
	} else if ((empty($password))) { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom password tidak boleh kosong"; 
		die(json_encode($response));
	} else if ((empty($confirm_password)) || $password != $confirm_password) { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Konfirmasi password tidak sama"; 
		die(json_encode($response));
	} else {
		if (!empty($username) && $password == $confirm_password){

			$coba = "SELECT * FROM users WHERE username='".$username."'";
			$num_rows = mysqli_num_rows(mysqli_query($connect,$coba));

			if ($num_rows == 0){
				$query = mysqli_query($connect,"INSERT INTO users (id_user, username, password, role, pendidikan, nama, minat, pekerjaan) 
				VALUES(0,'".$username."','".$password."','".$radio."','".$pendidikan."','".$nama."','".$minat."','".$pekerjaan."')");

				if ($query){
					$response = new usr();
					$response->success = 1;
					$response->message = "Register berhasil, silahkan login.";
					die(json_encode($response));

				} else {
					$response = new usr();
					$response->success = 0;
					$response->message = "Username sudah ada";
					die(json_encode($response));
				}
			} else {
				$response = new usr();
				$response->success = 0;
				$response->message = "Username sudah ada";
				die(json_encode($response));
			}
		}
	}

	mysql_close();


	/* ========= KALAU PAKAI MYSQLI YANG ATAS SEMUA DI REMARK, TERUS YANG INI DI UNREMARK ======== */
	// include_once "koneksi.php";

	// class usr{}
	
	// $username = $_POST["username"];
	// $password = $_POST["password"];
	// $confirm_password = $_POST["confirm_password"];
	
	// if ((empty($username))) { 
	// 	$response = new usr();
	// 	$response->success = 0;
	// 	$response->message = "Kolom username tidak boleh kosong"; 
	// 	die(json_encode($response));
	// } else if ((empty($password))) { 
	// 	$response = new usr();
	// 	$response->success = 0;
	// 	$response->message = "Kolom password tidak boleh kosong"; 
	// 	die(json_encode($response));
	// } else if ((empty($confirm_password)) || $password != $confirm_password) { 
	// 	$response = new usr();
	// 	$response->success = 0;
	// 	$response->message = "Konfirmasi password tidak sama"; 
	// 	die(json_encode($response));
	// } else {
	// 	if (!empty($username) && $password == $confirm_password){
	// 		$query = mysqli_query($con, "INSERT INTO users (id, username, password) VALUES(0,'".$username."','".$password."')");
			
	// 		if ($query){
	// 			$response = new usr();
	// 			$response->success = 1;
	// 			$response->message = "Register berhasil, silahkan login.";
	// 			die(json_encode($response));
				
	// 		} else { 
	// 			$response = new usr();
	// 			$response->success = 0;
	// 			$response->message = "Username sudah ada";
	// 			die(json_encode($response));
	// 		}
	// 	}	
	// }

	// mysqli_close($con);

?>	