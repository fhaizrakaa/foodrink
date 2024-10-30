<?php
    // memanggil file koneksi.php untuk membuat koneksi
    include('koneksi.php');

    // membuat variabel untuk menampung data dari form
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $gambar_produk = $_FILES['gambar_produk']['name'];
    
    if($gambar_produk != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg'); //ekstensi gmbr yg d izinkan
        $x = explode('.', $gambar_produk);  //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar_produk']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak.' - '.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); //memindah file gambar ke folder gambar

            // jalankan query UPDATE berdasarkan ID yang produknya kita edit 
            $query = "UPDATE foodrnk SET nama_produk = '$nama_produk', deskripsi = '$deskripsi', harga_beli = '$harga_beli', harga_jual 
            = '$harga_jual', gambar_produk = '$nama_gambar_baru'" ;
            // -- WHERE id = $id";
            $query .= "WHERE id = '$id'";

            $result = mysqli_query($koneksi, $query);
            // periska query apakah ada error
            if(!$result) {
                die ("Query Error: ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
            }
            else {
                // kalo berhasil pindah halaman ke index.php 
                echo "<script>alert('Data berhasil diubah!');window.location='index.php';</script>";
            }

        } else {
            // jika ekstensi tdk jpg dan png akan mnampilkan ini
            echo "<script>alert('Ekstensi gambar hanya bisa jpg dan png!');window.location='edit_produk.php';</script>";
        }
    } else {
        // jalankan query UPDATE berdasarkan ID yang produknya kita edit
        $query = "UPDATE foodrnk SET nama_produk = '$nama_produk', deskripsi = '$deskripsi', harga_beli = '$harga_beli', harga_jual = '$harga_jual'";
          // dimana id nya? mending gwsh pake
        // $query = "WHERE id = '$id'";
        $query = "WHERE id = '$id'";

        $result = mysqli_query($koneksi, $query);

        if(!$result) {
            die ("Query Error : ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
        }
        else {
            echo "<script>alert('Data berhasil diubah!');window.location='index.php';</script>";
        }
    }
?>