<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']) {
    header('location: login.php');
    exit();
}

// Mendapatkan data transaksi untuk ditampilkan
$sqlTransaksis = "SELECT * FROM transaksis";
$resultTransaksis = $mysqli->query($sqlTransaksis);

// Delete functionality
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $sqlDelete = "DELETE FROM transaksis WHERE sewa_id = $deleteId";
    $mysqli->query($sqlDelete);
    header('location: data_transaksi.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
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

        @media print {
            body * {
                visibility: hidden;
            }

            #print-section, #print-section * {
                visibility: visible;
            }

            #print-section {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>
    <h2>Data Transaksi</h2>
    <?php if ($resultTransaksis !== false && $resultTransaksis->num_rows > 0) : ?>
        <table border="1">
            <tr>
                <th>Sewa ID</th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>Lama Sewa</th>
                <th>Alamat</th>
                <th>PS ID</th>
                <th>Total Harga</th>
                <th>Actions</th>
            </tr>
            <?php while ($rowTransaksi = $resultTransaksis->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $rowTransaksi['sewa_id']; ?></td>
                    <td><?php echo $rowTransaksi['nama']; ?></td>
                    <td><?php echo $rowTransaksi['No_Telepon']; ?></td>
                    <td><?php echo $rowTransaksi['lama_sewa']; ?></td>
                    <td><?php echo $rowTransaksi['alamat']; ?></td>
                    <td><?php echo $rowTransaksi['ps_id']; ?></td>
                    <td><?php echo "Rp " . number_format($rowTransaksi['total_harga'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="?delete_id=<?php echo $rowTransaksi['sewa_id']; ?>" onclick="return confirm('yakin hapus data?')">Delete</a>
                        |
                        <a href="print.php?id=<?php echo $rowTransaksi['sewa_id']; ?>" target="_blank">Print</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>Tidak ada data transaksi.</p>
    <?php endif; ?>
    <a href="index.php" class="back-to-index">Kembali</a>
</body>
</html>
