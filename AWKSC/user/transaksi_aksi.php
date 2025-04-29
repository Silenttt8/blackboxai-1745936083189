<?php 
include '../koneksi.php';
session_start();

// menangkap data yang dikirim dari form
$tanggal = $_POST['tanggal'];
$durasi = $_POST['durasi'];
$metode_pembayaran = $_POST['metode_pembayaran'];
$pelanggan = $_SESSION['username']; // ambil username yang login

// set timezone dan waktu
date_default_timezone_set('Asia/Jakarta');
$jam_pemesanan = date('Y-m-d H:i:s');
$jam_mulai = "08:00:00"; // default jam mulai
$jam_selesai = date('H:i:s',strtotime("$jam_mulai +$durasi hour"));

// ambil harga per jam
$h = mysqli_query($koneksi,"select harga_per_jam from harga");
$harga = mysqli_fetch_assoc($h);
$total_harga = $durasi * $harga['harga_per_jam'];

// upload bukti pembayaran
$bukti_pembayaran = "";
if(isset($_FILES['bukti_pembayaran'])){
    $file = $_FILES['bukti_pembayaran'];
    $target_dir = "../uploads/";
    
    // buat folder jika belum ada
    if(!file_exists($target_dir)){
        mkdir($target_dir, 0777, true);
    }
    
    // generate nama file unik
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = 'bukti_' . time() . '.' . $ext;
    $target_file = $target_dir . $filename;
    
    // upload file
    if(move_uploaded_file($file["tmp_name"], $target_file)){
        $bukti_pembayaran = $filename;
    }
}

// simpan ke database
mysqli_query($koneksi,"insert into transaksi values(
    '',
    '$jam_pemesanan',
    '$tanggal',
    '$pelanggan',
    '$jam_mulai',
    '$total_harga',
    '$durasi',
    '$jam_selesai',
    '0',
    '0',
    '$metode_pembayaran',
    '$bukti_pembayaran'
)");

// redirect ke halaman transaksi
header("location:transaksi.php");
?>
