<?php 
 $koneksi = mysqli_connect('localhost', 'root', '');
 mysqli_select_db($koneksi,'ebook2');
 $hasil = mysqli_query($koneksi,"SELECT * FROM buku") or die(mysqli_error($koneksi));
 $json_response = array();

if(mysqli_num_rows($hasil)> 0){
while ($row = mysqli_fetch_array($hasil)) {
$json_response[] = $row;
}
echo json_encode(array('chatroom' => $json_response));}
?>