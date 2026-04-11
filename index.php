<?php
include './config/koneksi.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda-Galeri-Foto</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="bg-slate-900 text-white p-4 shadow-md flex justify-between items-center">
    <h1 class="text-2xl font-bold tracking-tight text-white-400">Galeri Foto</h1>
    <div class="flex items-center gap-4">
        <?php if (isset($_SESSION['nama'])) : ?>
            <span class="text-sm text-slate-400 hidden sm:inline">Hi, <b><?php echo $_SESSION['nama']; ?></b></span> 
            <a href="tambah_foto.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all text-sm">+ Upload Foto</a>
            <a href="logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition-all text-sm">Logout</a>
        <?php else : ?>
            <span class="text-sm text-slate-500 mr-2 italic">Hi Guest</span>
            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition-all shadow-lg shadow-blue-500/20" href="login.php">Login</a>
        <?php endif; ?>
    </div>
</header>
</body>
</html>