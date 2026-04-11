<?php
include './config/koneksi.php';

if (isset($_POST['register'])) {
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $cek_email = mysqli_query($koneksi, "SELECT email FROM users WHERE email = '$email'");
    
    if (mysqli_num_rows($cek_email) > 0) {
        echo "<script>
                alert('Maaf, email ini sudah terdaftar! Gunakan email lain.');
                window.history.back();
              </script>";
    } else {
        $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password', 'user')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Berhasil daftar! Silakan login.');
                    window.location.href='login.php';
                  </script>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
    body { font-family: 'Poppins', sans-serif; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 flex items-center justify-center min-h-screen"> 
    <form method="POST" class="w-full max-w-md p-8 bg-slate-900 rounded-xl shadow-2xl border border-slate-800">
        <h2 class="text-3xl font-bold mb-8 text-center text-white">Daftar Akun</h2>
        <div class="space-y-4"> 
                        <input type="text" name="name" placeholder="Nama" required class="w-full border border-slate-700 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-800 text-white placeholder:text-gray-500" maxlength="25">
            <input type="text" name="email" placeholder="Email" required class="w-full border border-slate-700 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-800 text-white placeholder:text-gray-500">
            <input type="password" name="password" placeholder="Password" required class="w-full border border-slate-700 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-800 text-white placeholder:text-gray-500" maxlength="12">
        </div>
        <div class="mt-8 flex justify-center">
            <button type="submit" name="register" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-lg transition-all transform hover:scale-105">
                Daftar
            </button>
        </div>
        <p class="text-center text-slate-400 mt-6 text-sm">
            Sudah punya Akun? <a href="login.php" class="text-blue-400 hover:text-blue-300 font-semibold underline decoration-2 underline-offset-4">Login di sini</a> 
        </p>
    </form>

</body>
</html>