<?php
$koneksi = mysqli_connect("localhost", "root", "", "selectro");

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
