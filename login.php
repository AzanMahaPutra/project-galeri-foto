<?php
session_start();
include './config/koneksi.php';

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
        echo "<script>alert('Email atau password salah!'); window.location.href='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 flex items-center justify-center min-h-screen text-white p-4">
    <form method="POST" class="w-full max-w-md p-8 bg-slate-900 rounded-2xl border border-slate-800 shadow-2xl">
        <h2 class="text-3xl font-bold mb-8 text-center text-blue-400">Login</h2>
        <div class="space-y-4"> 
            <input type="text" name="email" placeholder="Email" required class="w-full border border-slate-700 rounded-lg py-3 px-4 bg-slate-800 focus:ring-2 focus:ring-blue-500 outline-none">
            <input type="password" name="password" placeholder="Password" required class="w-full border border-slate-700 rounded-lg py-3 px-4 bg-slate-800 focus:ring-2 focus:ring-blue-500 outline-none">
        </div>
        <button type="submit" name="login" class="w-full bg-blue-600 hover:bg-blue-700 font-bold py-3 rounded-lg mt-8 transition-all">Login</button>
        <p class="text-center text-slate-400 mt-6 text-sm">Belum punya Akun? <a href="register.php" class="text-blue-400 underline">Daftar</a></p>
    </form>
</body>
</html>