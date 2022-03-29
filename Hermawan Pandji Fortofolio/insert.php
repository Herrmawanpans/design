<?php 
    $con = mysqli_connect("localhost","root");
    if (!$con)
      {
        die('Could not connect to server : ' . mysqli_error());
      }
    
    $selected = mysqli_select_db($con, "data_mahasiswa");
    if (!$selected) 
    {
        die('Could not connect database : ' . mysqli_error());
    }
        
    $sql="INSERT INTO mahasiswa_ppw(Nama, Fakultas, Angkatan)
          VALUES ('$_POST[nama]','$_POST[fakultas]','$_POST[angkatan]')";
    if (!mysqli_query($con, $sql))
      {
        die('Error inserting to table: ' . mysqli_error($con));
      }
      
     mysqli_close($con);
     header("Location: index.php");
     exit;
?>
<!-- 
    cara penyimpanan file index.php & insert.php ngikutin di soal
    YANG INI GAUSAH DIJALANIN
    cara jalanin (untuk ngetes): web browser -> http://localhost/sqlphp/insert.php
    mysql_xxx digunakan di php 4 (yang diupload di pjj)
    mysqli_xxx digunakan di php 5 ke atas (terbaru)
    select_db & query mengalami perubahan posisi parameter, dimana $con menjadi parameter pertama (php 5 ke atas)
-->