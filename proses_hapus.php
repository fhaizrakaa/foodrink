<?php
// memanggil file koneksi.php untuk membuat koneksi
    include('koneksi.php');

    $id = $_GET['id']; //mengmbil id yg ingin d hapus
    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM foodrnk where id = '$id'";
    $result = mysqli_query($koneksi, $query);

    // jika koneksi ke variable $koneksinya gagal maka querry gagal, jika berhasil pindah halaman ke index.php 
    if(!$result) {
        die ("Query Error: ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
    }
    else {
        echo "<script>alert('Data berhasil dihapus!');window.location='index.php';</script>";
    }

?>