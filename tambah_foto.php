<?php
session_start();
include './config/koneksi.php';

if (isset($_POST['upload'])) {
    $judul_foto = $_POST['judul_foto'];
    $deskripsi_foto = $_POST['deskripsi_foto'];
    $tanggal_unggah = date('Y-m-d');
    $user_id = $_SESSION['user_id'];

    $filename = $_FILES['lokasi_file']['name'];
    $tmp_name = $_FILES['lokasi_file']['tmp_name'];
    
    $ekstensi = pathinfo($filename, PATHINFO_EXTENSION);
    $nama_baru = time() . '-' . rand(100, 999) . '.' . $ekstensi;
    $target_folder = 'upload/' . $nama_baru;

    if (!is_dir('upload')) {
        mkdir('upload', 0777, true);
    }

    if (move_uploaded_file($tmp_name, $target_folder)) {
        $query = "INSERT INTO foto (judul_foto, deskripsi_foto, tanggal_unggah, lokasi_file, user_id) 
                  VALUES ('$judul_foto', '$deskripsi_foto', '$tanggal_unggah', '$nama_baru', '$user_id')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Berhasil diunggah!'); window.location.href='index.php';</script>";
        } else {
            echo "Error Database: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal upload ke folder.";
    }
}
?>