<?php
// Nama File: export_csv.php
// Deskripsi: File ini merupakan file untuk mengubah 
// Dibuat oleh : Muhammad Ilham Tri adi Putra - NIM : 3312411003 (PHP)
// Tanggal: 26 Desember 2024

// Koneksi ke database
include './koneksi.php';

// Mendapatkan parameter status dari URL
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Set header untuk mengunduh file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="laporan_pembelian.csv"');

// Membuka file output CSV
$output = fopen('php://output', 'w');

// Menulis header kolom CSV
fputcsv($output, array('No', 'Nama Pembeli', 'Alamat', 'Total Pembayaran', 'Status', 'Tanggal Pembelian'));

// Query untuk mengambil data berdasarkan status filter
if ($status_filter == 'completed') {
    // Menampilkan data dengan status 'completed'
    $query = "
        SELECT p.id_pembelian, u.username, u.address, p.total_bayar, p.status_pembelian, p.tanggal_pembelian
        FROM pembelian p
        JOIN users u ON p.id_users = u.id_users
        WHERE p.status_pembelian = 'completed'
    ";
} else {
    // Jika filter status tidak ada atau memilih "all", tampilkan semua data
    $query = "
        SELECT p.id_pembelian, u.username, u.address, p.total_bayar, p.status_pembelian, p.tanggal_pembelian
        FROM pembelian p
        JOIN users u ON p.id_users = u.id_users
    ";
}

$result = mysqli_query($koneksi, $query);

// Menulis data baris demi baris ke file CSV
$no = 1;
while ($data = mysqli_fetch_assoc($result)) {
    // Menyiapkan data untuk setiap baris CSV
    $row = array(
        $no++, 
        $data['username'], 
        $data['address'], // Menambahkan alamat
        'Rp' . number_format($data['total_bayar'], 2, ',', '.'), 
        ucfirst($data['status_pembelian']),  // Menampilkan status dengan huruf kapital pertama
        $data['tanggal_pembelian']
    );
    
    // Menulis data ke file CSV
    fputcsv($output, $row);
}

// Menutup file output CSV
fclose($output);
exit;
?>
