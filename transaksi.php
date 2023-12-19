
<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']) {
    header('location: login.php');
    exit();
}

// Mendapatkan data produk untuk menampilkan dalam dropdown
$sqlProduks = "SELECT * FROM produks";
$resultProduks = $mysqli->query($sqlProduks);
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sewa_id = $_POST['sewa_id'];
    $nama = $_POST['nama'];
    $No_Telepon = $_POST['No_Telepon'];
    $lama_sewa = $_POST['lama_sewa'];
    $alamat = $_POST['alamat'];
    $ps_id = $_POST['ps_id'];

    // Mendapatkan harga perjam dari tabel produk
    $sqlGetHarga = "SELECT harga_perjam FROM produks WHERE ps_id = '$ps_id'";
    $resultGetHarga = $mysqli->query($sqlGetHarga);
    $rowGetHarga = $resultGetHarga->fetch_assoc();
    $harga_perjam = $rowGetHarga['harga_perjam'];

    // Menghitung total harga
    $total_harga = $lama_sewa * $harga_perjam;

    // Jika id produk valid, maka lakukan penyisipan data transaksi
    $sql = "INSERT INTO transaksis (sewa_id, nama, No_Telepon, lama_sewa, alamat, ps_id, total_harga) VALUES ('$sewa_id', '$nama', '$No_Telepon', '$lama_sewa', '$alamat', '$ps_id', '$total_harga')";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: data_transaksi.php"); // Redirect ke tampilan Read setelah berhasil tambah data
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi</title>
    <script>
        // Fungsi untuk menghitung total harga secara otomatis
        function hitungTotalHarga() {
            var lamaSewa = document.getElementById("lama_sewa").value;
            var hargaPerJam = document.querySelector('select[name="ps_id"]').options[document.querySelector('select[name="ps_id"]').selectedIndex].text.split(" - ")[3];
            var totalHarga = lamaSewa * hargaPerJam;
            document.getElementById("harga_perjam").value = hargaPerJam;
            document.getElementById("total_harga").value = totalHarga;
        }
    </script>
</head>
      <style>
         body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: grey;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #0066cc;
            color: #fff;
            cursor: pointer;
        }

        a.back-to-index {
            display: block;
            background-color: #0066cc;
            color: #fff;
            cursor: pointer;
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
        }
        h2 {
            text-align: center;
        }

        input[type="submit"]:hover,
        a.back-to-index:hover {
            background-color: #004080;
        }
    </style>
<body>
    <h2>Form Transaksi</h2>
    <form action="#" method="POST" enctype="multipart/form-data">
        <!-- ... (bagian lain dari form) ... -->
        ID: <input type="text" name="sewa_id"><br>
        Nama: <input type="text" name="nama"><br>
        No Telepon: <input type="text" name="No_Telepon"><br>
        Lama Sewa:
        <input type="text" name="lama_sewa" id="lama_sewa" onchange="hitungTotalHarga()" required><br>
        Alamat: <input type="text" name="alamat"><br>

        <!-- Pilih produk dari dropdown -->
        PS ID:
        <select name="ps_id" onchange="hitungTotalHarga()" required>
            <?php
            while ($rowProduk = $resultProduks->fetch_assoc()) {
                echo "<option value='".$rowProduk["ps_id"]."'>".$rowProduk["ps_id"]." - ".$rowProduk["jenis_ps"]." - ".$rowProduk["warna"]." - ".$rowProduk["harga_perjam"]."</option>";
            }
            ?>
        </select>
        <br>

        Harga Perjam:
        <input type="text" name="harga_perjam" id="harga_perjam" value="" readonly><br>

        TOTAL: <input type="text" name="total_harga" id="total_harga" value="" readonly><br>
        <input type="submit" value="Tambah">
        <a href="index.php" class="back-to-index">Kembali</a>
    </form>

    <script>
        // Inisialisasi nilai harga perjam saat halaman dimuat
        document.getElementById("harga_perjam").value = document.querySelector('select[name="ps_id"]').options[document.querySelector('select[name="ps_id"]').selectedIndex].text.split(" - ")[3];

        // Inisialisasi nilai total harga saat halaman dimuat
        hitungTotalHarga();
    </script>
</body>
</html>
