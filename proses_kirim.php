<?php 
  if (isset($_POST['kirim'])) {
  	$nama=$_POST['nama'];
  	$pesan=$_POST['pesan'];
  	$whatsapp=$_POST['whatsapp'];
       $whatsappURL = "https://api.whatsapp.com/send?phone=+$whatsapp&text=" . urlencode($pesan);
    header('Location: ' . $whatsappURL);
    }else {
        echo "gagal";
    }
 ?>