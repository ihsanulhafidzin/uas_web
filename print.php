<?php
include 'koneksi.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $printId = $_GET['id'];

    // Fetch the specific transaction details
    $sqlPrint = "SELECT * FROM transaksis WHERE sewa_id = $printId";
    $resultPrint = $mysqli->query($sqlPrint);

    // Check if the query was successful
    if ($resultPrint) {
        $rowPrint = $resultPrint->fetch_assoc();
    } else {
        die("Error retrieving data: " . $mysqli->error);
    }
} else {
    // Redirect to the main page if 'id' is not set
    header('location: data_transaksi.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Transaction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Transaction Details</h2>
    <table>
        <tr>
            <th>Sewa ID</th>
            <td><?php echo $rowPrint['sewa_id']; ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?php echo $rowPrint['nama']; ?></td>
        </tr>
        <tr>
            <th>No Telepon</th>
            <td><?php echo $rowPrint['No_Telepon']; ?></td>
        </tr>
        <tr>
            <th>Lama Sewa</th>
            <td><?php echo $rowPrint['lama_sewa']; ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?php echo $rowPrint['alamat']; ?></td>
        </tr>
        <tr>
            <th>PS ID</th>
            <td><?php echo $rowPrint['ps_id']; ?></td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td><?php echo "Rp " . number_format($rowPrint['total_harga'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <script>
        // Automatically trigger the print dialog when the page is loaded
        window.onload = function () {
            window.print();
        }
    </script>
</body>
</html>
