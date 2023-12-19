<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']){
    header('location: login.php');
    exit();
}
include 'koneksi.php';

$id = $_GET['id'];

// cek apakah form telah disubmit untuk melakukan pembaruan data
if (isset($_POST['update'])) {
    $ps_id = $_POST['ps_id'];
    $jenis_ps = $_POST['jenis_ps'];
    $warna = $_POST['warna'];
    $harga_perjam = $_POST['harga_perjam'];

//  pembaruan data
    $result = mysqli_query($mysqli, "UPDATE produks SET ps_id='$ps_id', jenis_ps='$jenis_ps', warna='$warna', harga_perjam='$harga_perjam' WHERE ps_id=$id");

    header("Location: produk.php");
}

// ambil data buku berdasarkan ID
$sql = "SELECT * FROM produks WHERE ps_id='$id'";
$result = $mysqli->query($sql);

// tampilkan form untuk mengedit data buku
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Edit Data Buku</title>
    </head>
    <body>

        <form action="update.php?id=<?php echo $id; ?>" method="POST">
            ID: <input type="text" name="ps_id" value="<?php echo $row['ps_id']; ?>"><br>
            Jenis Ps: <input type="text" name="jenis_ps" value="<?php echo $row['jenis_ps']; ?>"><br>
            Warna: <input type="text" name="warna" value="<?php echo $row['warna']; ?>"><br>
            Harga Perjam: <input type="text" name="harga_perjam" value="<?php echo $row['harga_perjam']; ?>"><br>
            <input type="hidden" name="id" value="<?php echo $row['ps_id']; ?>">
            <input type="submit" name="update" value="Update">
        </form>

    </body>
    </html>

<?php
} else {
    echo "Data tidak ditemukan.";
}

// tutup koneksi database
$mysqli->close();
?>
