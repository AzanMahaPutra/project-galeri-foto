<?php
session_start();
include './config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Login dulu bro kalau mau Like!'); window.location.href='login.php';</script>";
    exit();
}

$foto_id = $_GET['foto_id'];
$user_id = $_SESSION['user_id'];
$tanggal = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO like_foto (foto_id, user_id, tanggal_like) VALUES ('$foto_id', '$user_id', '$tanggal')");

if ($query) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Gagal Like!";
}
?>