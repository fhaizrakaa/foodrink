<?php
    include('koneksi.php');

    // membuat variabel untuk menampung data dari form
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    // meng-upload file, seperti dbwh ini file gambar 
    $gambar_produk = $_FILES['gambar_produk']['name'];
    
    if($gambar_produk != "") {

        // jenis gambar yg d izinkan 
        $ekstensi_diperbolehkan = array('png', 'jpg'); 
        // selain d atas gagal 
        $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar_produk']['tmp_name'];

        // untuk urutan nomor data 
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak.'-'.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {

            //memindah file gambar ke folder gambar
            move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru);
            
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $query = "INSERT INTO foodrnk (nama_produk, deskripsi, harga_beli, harga_jual, gambar_produk) VALUES ('$nama_produk', '$deskripsi', '$harga_beli', '$harga_jual', '$nama_gambar_baru')";
            $result = mysqli_query($koneksi, $query);

            if(!$result) {
                die ("Query Error: ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
            }
            else {
                // jika jenis gambar sesuai akan mencetak ini 
                //tampil alert dan akan redirect ke halaman index.php
                echo "<script>alert('Data berhasil ditambahkan!');window.location='index.php';</script>";
            }

        } else {
            // jika jenis gmbr tdk sesuai akan mencetak ini 
            echo "<script>alert('Ekstensi gambar hanya bisa jpg dan png!');window.location='tambah_produk.php';</script>";
        }
    } else {
        //untuk mnambahkan data k dtbse
        $query = "INSERT INTO foodrnk (nama_produk, deskripsi, harga_beli, harga_jual) VALUES ('$nama_produk',
        '$deskripsi', '$harga_beli', '$harga_jual')";
            $result = mysqli_query($koneksi, $query);

            // koneksi ke variable $koneksinya gagal maka querry gagal, kalo berhasil pindah halaman ke index.php 
            if(!$result) {
                die ("Query Error: ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
            }
            else {
                echo "<script>alert('Data berhasil ditambahkan!');window.location='index.php';</script>";
            }
    }
?>