<?php
include 'koneksi.php';

// Menambahkan kolom baru ke tabel transaksi
$sql = "ALTER TABLE transaksi 
        ADD COLUMN metode_pembayaran VARCHAR(50) AFTER transaksi_lap,
        ADD COLUMN status_pembayaran VARCHAR(20) DEFAULT 'pending' AFTER metode_pembayaran,
        ADD COLUMN bukti_pembayaran VARCHAR(255) NULL AFTER status_pembayaran";

if (mysqli_query($koneksi, $sql)) {
    echo "Kolom baru berhasil ditambahkan";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
