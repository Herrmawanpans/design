<!DOCTYPE html>
<html>
	<head>
		<meta charset ="utf-8">
		<title>SQL & PHP</title>		
	</head>
    
    <body>
    <?php 
        // Connect to server
        $con = mysqli_connect("localhost","root");
        if (!$con)
          {
            die('Could not connect: ' . mysqli_error());
          }
       
        //select a database & table
        $selected = mysqli_select_db($con, "data_mahasiswa");
        if (!$selected) //Apabila baru pertama kali dijalankan akan membuat database dan tabel baru
        { 
              //Create new database
            $sql="CREATE DATABASE data_mahasiswa";
            if (mysqli_query($con, $sql)) {
              echo "Database created successfully \n";
            } else {
              echo "Error creating database: " . mysqli_error($con);
            }
            
              //Connect to database
            if (!mysqli_select_db($con, "data_mahasiswa")) {
              echo "Error connect to database: " . mysqli_error($con);
            } else {
              //Create new table
                $sql="CREATE TABLE mahasiswa_ppw 
                (ID INT NOT NULL AUTO_INCREMENT, 
                  PRIMARY KEY (ID),
                  Nama varchar(100),
                  Fakultas varchar(100),
                  Angkatan INT
                )";
                
                if (mysqli_query($con, $sql)) {
                  echo "Table created successfully";
                } else {
                  echo "Error creating Table : " . mysqli_error($con);
                }
            }                
        } else { //Apabila sudah ada database dan tabelnya, maka menunjukan isi dari tabel tersebut
            mysqli_select_db($con, "data_mahasiswa");
            
            //Show data from table mahasiswa_ppw
            $getdb = "SELECT * FROM mahasiswa_ppw";
            $resultdb = mysqli_query($con, $getdb);
            if (!$resultdb) {
                echo "Cannot get data from table";
            } else {
            echo "<h3>Tabel Mahasiswa : </h3>";
            echo "<br>";
            echo "<table border=\"1\">";
            echo "<tr><td><b>ID</b></td><td><b>Nama</b></td><td><b>Fakultas</b></td><td><b>Angkatan</b></td></tr>";
                
            while ($row = mysqli_fetch_row($resultdb)) {
                print( "<tr>");		
                foreach($row as $key => $value) { 
                    print( "<td>$value</td>");
                }
                print( "</tr>");
            }
            echo "</table>";
            }
        }
        mysqli_close($con);
    ?>
    <br><br>
    
    
    <h3> Memasukkan data mahasiswa :</h3>
    <form action="insert.php" method="post">
    Nama: <input type="text" name="nama">
    Fakultas: <input type="text" name="fakultas">
    Angkatan: <input type="text" name="angkatan"> <br>
    <input type="submit">
    </form>

    
    </body>
</html>
<!-- 
    cara penyimpanan file index.php & insert.php ngikutin di soal
    cara jalanin: web browser -> http://localhost/sqlphp/index.php
    mysql_xxx digunakan di php 4 (yang diupload di pjj)
    mysqli_xxx digunakan di php 5 ke atas (terbaru)
    select_db & query mengalami perubahan posisi parameter, dimana $con menjadi parameter pertama (php 5 ke atas)
-->