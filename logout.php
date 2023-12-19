<?php
session_start(); // Mulai sesi

// Hapus semua variabel sesi
session_unset();

// Hapus sesi
session_destroy();

// Redirect ke halaman login (ganti dengan halaman login yang sesuai)
header("Location: login.php");
exit();
?>
