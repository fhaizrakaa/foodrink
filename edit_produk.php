<?php 
    // memanggil file koneksi.php untuk membuat koneksi
    include('koneksi.php');

    // menampilkan data awal yg ingin kita edit 
    // Method GET Mengirimkan Data Tidak Langsung, menggunakan method GET, 
    // ketika mengisi nama sebagainya pasti data tersebut akan terlihat di URL. 
    // mengecek apakah di url ada nilai GET id
    if(isset($_GET['id'])) {
        // ambil nilai id dari url dan disimpan dalam variabel $id
        $id = $_GET['id'];

        // menampilkan data dari database yang mempunyai id=$id
        $query = "SELECT * FROM foodrnk where id = '$id'";
        $result = mysqli_query($koneksi, $query);

        // jika data gagal diambil maka akan tampil error berikut
        if(!$result) {
            die("Querry Error :".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
        }
        // mengambil data dari database
        $data = mysqli_fetch_assoc($result);

        // apabila data tidak ada pada database maka akan dijalankan perintah ini
        if(!count($data)) {
            echo "<script>alert('Data tidak ditemukan pada tabel');window.location='index.php'</script>";
        }

    } else {
        // apabila tidak ada data GET id pada akan di redirect ke index.php
        echo "<script>alert('Masukan ID yang ingin diedit');window.location='index.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food & Drink</title>
    <link rel="stylesheet" href="tambah.css">
</head>
<body>
    <center><h1>Edit Produk <?php echo $data['nama_produk']; ?></h1></center>
    <form method="POST" action="proses_edit.php" enctype="multipart/form-data">
    <section class="base">
        <div>
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" autofocus="" required="" value="<?php echo $data['nama_produk']; ?>" />
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        </div>
        <div>
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" value="<?php echo $data['deskripsi']; ?>" />
        </div>
        <div>
            <label>Harga Beli</label>
            <input type="text" name="harga_beli" required="" value="<?php echo $data['harga_beli']; ?>" />
        </div>
        <div>
            <label>Harga Jual</label>
            <input type="text" name="harga_jual" required="" value="<?php echo $data['harga_jual']; ?>" />
        </div>
        <div>
            <label>Gambar Produk</label>
            <img src="gambar/<?php echo $data['gambar_produk']; ?>" style="width: 120px; float: left; margin-bottom: 5px;">
            <input type="file" name="gambar_produk" />
            <i style="float: left; font-size: 11px; color: red;">Abaikan jika tidak merubah gambar produk</i>
        </div>
        <div>
            <br>
            <button type="submit">Simpan Perubahan</button>
        </div>
    </section>
    </form>
</body>
</html>