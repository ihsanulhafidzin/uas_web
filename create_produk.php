<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']){
    header('location: login.php');
    exit();
}

// Proses form jika ada data yang dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ps_id = $_POST['ps_id'];
    $jenis_ps = $_POST['jenis_ps'];
    $warna = $_POST['warna'];
    $harga_perjam = $_POST['harga_perjam'];

    // Gunakan parameterized query untuk menghindari SQL injection
    $sql = "INSERT INTO produks (ps_id, jenis_ps, warna, harga_perjam) VALUES (?, ?, ?, ?)";

    // Persiapkan statement
    $stmt = $mysqli->prepare($sql);

    // Bind parameter ke statement
    $stmt->bind_param("sssd", $ps_id, $jenis_ps, $warna, $harga_perjam);

    // Eksekusi statement
    $stmt->execute();

    // Tutup statement
    $stmt->close();
}

// Ambil data dari database untuk ditampilkan
$sqlProduks = "SELECT * FROM produks";
$resultProduks = $mysqli->query($sqlProduks);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #0066cc;
            color: #fff;
        }

        a {
            display: inline-block;
            margin: 5px;
            padding: 8px 15px;
            background-color: #0066cc;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #004080;
        }
    </style>
</head>
<body>
    <h2>Data Produk</h2>
    <form action="#" method="POST">
        ID: <input type="text" name="ps_id"><br>
        Jenis PS: <input type="text" name="jenis_ps"><br>
        Warna: <input type="text" name="warna"><br>
        Harga Perjam: <input type="text" name="harga_perjam" onkeyup="formatCurrency(this)" required><br>
        <input type="submit" value="Tambah">
    </form>

    <?php if ($resultProduks !== false && $resultProduks->num_rows > 0) : ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Jenis PS</th>
                <th>Warna</th>
                <th>Harga Perjam</th>
            </tr>
            <?php while ($rowProduk = $resultProduks->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $rowProduk['ps_id']; ?></td>
                    <td><?php echo $rowProduk['jenis_ps']; ?></td>
                    <td><?php echo $rowProduk['warna']; ?></td>
                    <td><?php echo "Rp " . number_format($rowProduk['harga_perjam'], 0, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>Tidak ada data produk.</p>
    <?php endif; ?>

    <a href="index.php">Kembali</a>
</body>
</html>
