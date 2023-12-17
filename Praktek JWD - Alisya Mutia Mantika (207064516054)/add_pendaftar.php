<?php
 include_once ("connection.php");

 if ($_POST) {
    $file_upload = $_FILES['berkas'];

 if ($file_upload['name'] != ""){
     $nama = $_POST['nama'];
     $email = $_POST['email'];
     $hp = $_POST['hp'];
     $alamat = $_POST['alamat'];
     $semester = $_POST['semester'];
     $ipk = $_POST['ipk'];
     $beasiswa = $_POST['beasiswa'];
     $status = "Belum di verifikasi";
     $berkas =$file_upload['name'];

//Perintah SQL untuk tambah data ke database mySql
$result = mysqli_query($conn, "INSERT INTO registrasi (nama, email, hp, alamat, semester, ipk, beasiswa, berkas, status) 
                               VALUES ('$nama', '$email', '$hp', '$alamat', '$semester', '$ipk', '$beasiswa', '$berkas', '$status')");

//built in function php untuk upload
move_uploaded_file($file_upload['tmp_name'], __DIR__ ."/uploads/" . $berkas);

header("Location: index.php?link_page=3");

  }
}

?>
