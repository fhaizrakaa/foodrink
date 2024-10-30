<?php
include('koneksi.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Food & Drink</title>
  <link rel="stylesheet" href="sheet.css">
</head>
<body>
<div class="fContainer">
        <nav class="wrapper">
            <div class="brand">
                <div class="firts">FooD</div>
                <div class="tengah">&</div>
                <div class="last">Drinks</div>
            </div>
            <ul class="navigation">
                <!-- <li><a href="">Beranda</a></li> -->
                <!-- <li><a href="">Keranjang</a></li> -->
                <li><a href="https://www.instagram.com/jennolye_?igsh=d2ppMnN2a29pNms2">Tentang kami✩彡</a></li>
            </ul>
        </nav>
        
    </div>

    <center><h1>MENU</h1></center>
    <br>
    <center class="tambah"><a href="tambah_produk.php">+ &nbsp; Tambah Produk</a></center>
    <br>
    <table border="2px" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Produk</th>
                <th>Deskripsi</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
             // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                $query = "SELECT * FROM foodrnk ORDER BY id ASC";
                $result = mysqli_query($koneksi, $query);

                 //mengecek apakah ada error ketika menjalankan query
                if (!$result) {
                    die ("Query Error: ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
                }  

                if(mysqli_num_rows($result) > 0) { // Cek baris yang di return
                    $no = 1; //variabel untuk membuat no urut

                    // hasil query akan disimpan dalam variabel $data dalam bentuk array
                    // kemudian dicetak dengan perulangan while
                    while ($row = mysqli_fetch_assoc($result)) {
                        $gambar_produk = $row['gambar_produk'];
                        $path_to_image = "gambar/" . $gambar_produk;
                        if (file_exists($path_to_image)) { // Cek gambar
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row['nama_produk']; ?></td>
                <td><?php echo substr($row['deskripsi'], 0); ?></td>
                <td>Rp <?php echo number_format($row['harga_beli'],0,',','.'); ?></td>
                <td>Rp <?php echo number_format($row['harga_jual'],0,',','.'); ?></td>
                <td style="text-align: center;"><img src="<?php echo $path_to_image; ?>" style="width: 120px;"></td>
                <td>
                    <a href="edit_produk.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
                 </td>
            </tr>
            <?php
                        } else {
                            // Kalo gambar ga ada, kasih warn
                            echo "<tr><td colspan='7'>Gambar tidak ditemukan.</td></tr>";
                        }
                        $no++; //untuk no urut trs brtmbah 1
                    } // Closed While
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data produk.</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
