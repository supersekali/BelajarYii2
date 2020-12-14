<?php 
$arr = array();

$aVar = mysqli_connect('localhost','root','','ebook2');
$q = mysqli_query($aVar,"select * from kuis order by rand() limit 10");
 while ($row = mysqli_fetch_assoc($q)) {
 $temp = array(
 "id_kuis" => $row['id_kuis'],
 "soal"=>$row['soal'],
 "pilihan_a"=>$row['pilihan_a'],
 "pilihan_b"=>$row['pilihan_b'],
 "pilihan_c" => $row['pilihan_c'],
 "pilihan_d"=>$row['pilihan_d'],
 "pilihan_e" => $row['pilihan_e'],
 "pilihan_benar" => $row['pilihan_benar'], 
 );
 array_push($arr, $temp);
 }
 $data = json_encode($arr);
 $data = str_replace("\\", "", $data);
 echo "{\"daftar_soal\":" . $data . "}";
?>