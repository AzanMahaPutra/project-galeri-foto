<?php
session_start();
include './config/koneksi.php';

$error_login = false;

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $data['id_user']; 
        $_SESSION['nama']    = $data['nama'];
        $_SESSION['email']   = $data['email'];
        $_SESSION['role']    = $data['role'];
        
        header("Location: index.php");
        exit();
    } else {
        $error_login = true; // Set error menjadi true jika gagal
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galeri</title>
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
            <i data-lucide="lock" class="text-blue-600 w-10 h-10"></i> Login
        </h2>
        
        <div class="space-y-4"> 
            <input type="email" name="email" placeholder="Alamat Email" required class="w-full border border-gray-200 rounded-lg py-3 px-4 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none text-gray-800">
            <input type="password" name="password" placeholder="Password" required class="w-full border border-gray-200 rounded-lg py-3 px-4 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none text-gray-800">
        </div>
        
        <button type="submit" name="login" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg mt-8 transition-all flex justify-center items-center gap-2 shadow-sm">
            Masuk <i data-lucide="chevron-right" class="w-4 h-4"></i>
        </button>

        <p class="text-center text-gray-500 mt-6 text-sm">
            Belum punya Akun? <a href="register.php" class="text-blue-600 hover:text-blue-700 font-semibold underline decoration-2 underline-offset-4">Daftar di sini</a> 
        </p>
    </form>

    <script>
        lucide.createIcons();

        <?php if ($error_login) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: 'Email atau password salah!',
                confirmButtonColor: '#2563eb',
                borderRadius: '15px'
            });
        <?php endif; ?>
    </script>
</body>
</html>