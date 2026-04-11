<?php
include './config/koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['nama']    = $data['nama'];
        $_SESSION['email']   = $data['email'];
        $_SESSION['role']    = $data['role'];
        
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Email atau password salah!'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galeri Foto</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 flex flex-col min-h-screen">
    <header class="bg-slate-900 text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-2xl font-bold text-blue-400">Galeri Foto</h1>
        <a class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-all" href="index.php">Home</a>
    </header>
    <main class="flex-grow flex items-center justify-center p-4">
        <form method="POST" class="w-full max-w-md p-8 bg-slate-900 rounded-2xl shadow-2xl border border-slate-800">
            <h2 class="text-3xl font-bold mb-8 text-center text-white">Login</h2>
            <div class="space-y-4"> 
                <div>
                    <label class="block text-slate-400 text-sm mb-2 ml-1">Email</label>
                    <input type="text" name="email" placeholder="Masukkan Email" required class="w-full border border-slate-700 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-800 text-white placeholder:text-gray-500">
                </div>
                <div>
                    <label class="block text-slate-400 text-sm mb-2 ml-1">Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password" required class="w-full border border-slate-700 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-800 text-white placeholder:text-gray-500">
                </div>
            </div>
            <div class="mt-8 flex justify-center">
                <button type="submit" name="login" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-12 rounded-lg transition-all transform hover:scale-105 w-full sm:w-auto">Login</button>
            </div>
            <p class="text-center text-slate-400 mt-8 text-sm">
                Belum punya Akun? <a href="register.php" class="text-blue-400 hover:text-blue-300 font-semibold underline decoration-2 underline-offset-4">Daftar di sini</a> 
            </p>
        </form>
    </main>

</body>
</html>