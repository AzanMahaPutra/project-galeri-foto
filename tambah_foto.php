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
                        title: 'Berhasil!',
                        text: 'Foto berhasil diunggah.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = 'index.php';
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
                        text: 'Database Error: " . addslashes(mysqli_error($koneksi)) . "'
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
        }
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
                    title: 'Oops...',
                    text: 'Gagal upload file ke folder server.'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
    }
}
?>