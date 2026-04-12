<?php
session_start();
include './config/koneksi.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$cek = mysqli_query($koneksi, "SELECT lokasi_file FROM foto WHERE foto_id='$id' AND user_id='$user_id'");
$data = mysqli_fetch_assoc($cek);

if ($data) {
    unlink("upload/" . $data['lokasi_file']); 
    mysqli_query($koneksi, "DELETE FROM foto WHERE foto_id='$id'"); 
    echo "<script>alert('Foto dihapus!'); window.location.href='my_photos.php';</script>";
}
?>