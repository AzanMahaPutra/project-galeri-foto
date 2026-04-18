<?php
include './config/koneksi.php';

$status_register = ''; 

if (isset($_POST['register'])) {
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $cek_email = mysqli_query($koneksi, "SELECT email FROM users WHERE email = '$email'");
    
    if (mysqli_num_rows($cek_email) > 0) {
        $status_register = 'email_ada';
    } else {
        $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password', 'user')";
        if (mysqli_query($koneksi, $query)) {
            $status_register = 'sukses';
        } else {
            $status_register = 'gagal';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4 text-gray-800"> 
    <form method="POST" class="w-full max-w-md p-8 bg-white rounded-2xl border border-gray-200 shadow-xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-blue-600"></div>

        <h2 class="text-3xl font-bold mb-8 text-center text-gray-800 flex flex-col items-center gap-2">
            <i data-lucide="user-plus" class="text-blue-600 w-10 h-10"></i> Daftar Akun
        </h2>
        
        <div class="space-y-4"> 
            <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full border border-gray-200 rounded-lg py-3 px-4 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none text-gray-800" maxlength="25">
            <input type="email" name="email" placeholder="Alamat Email" required class="w-full border border-gray-200 rounded-lg py-3 px-4 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none text-gray-800">
            <input type="password" name="password" placeholder="Password" required class="w-full border border-gray-200 rounded-lg py-3 px-4 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none text-gray-800" maxlength="12">
        </div>
        
        <button type="submit" name="register" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg mt-8 transition-all flex justify-center items-center gap-2 shadow-sm">
            Daftar Sekarang <i data-lucide="chevron-right" class="w-4 h-4"></i>
        </button>
        
        <p class="text-center text-gray-500 mt-6 text-sm">
            Sudah punya Akun? <a href="login.php" class="text-blue-600 hover:text-blue-700 font-semibold underline decoration-2 underline-offset-4">Login di sini</a> 
        </p>
    </form>

    <script>
        lucide.createIcons();

        <?php if ($status_register == 'email_ada') : ?>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Maaf, email ini sudah terdaftar! Gunakan email lain.',
                confirmButtonColor: '#2563eb',
                borderRadius: '15px'
            });
        <?php elseif ($status_register == 'sukses') : ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Berhasil mendaftar! Silakan login untuk melanjutkan.',
                confirmButtonColor: '#2563eb',
                borderRadius: '15px'
            }).then((result) => {
                window.location.href = 'login.php';
            });
        <?php elseif ($status_register == 'gagal') : ?>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal membuat akun. Silakan coba lagi.',
                confirmButtonColor: '#2563eb',
                borderRadius: '15px'
            });
        <?php endif; ?>
    </script>
</body>
</html>