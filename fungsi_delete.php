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
    
    echo "<!DOCTYPE html>
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
            .swal2-popup { font-family: 'Poppins', sans-serif !important; }
        </style>
    </head>
    <body style='background-color: #f1f5f9; font-family: \'Poppins\', sans-serif;'>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Terhapus!',
                text: 'Foto berhasil dihapus dari galeri.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'foto_saya.php'; // Arahkan kembali ke foto_saya.php
            });
        </script>
    </body>
    </html>";
} else {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
            .swal2-popup { font-family: 'Poppins', sans-serif !important; }
        </style>
    </head>
    <body style='background-color: #f1f5f9; font-family: \'Poppins\', sans-serif;'>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data foto tidak ditemukan.'
            }).then(() => {
                window.location.href = 'foto_saya.php';
            });
        </script>
    </body>
    </html>";
}
?>