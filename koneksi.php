<?php
  $host = "localhost"; 
  $user = "root";
  $pass = "";
  $nama_db = "belajar_database"; //nama dtbse
  $koneksi = mysqli_connect($host, $user, $pass, $nama_db); 

  // jika koneksi gagal maka cetak ini 
  if(!$koneksi){
    die ("Koneksi dengan database gagal: ".mysqli_connect_error());
  }
?>