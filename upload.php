<?php
session_start();
include './config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload - Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-white min-h-screen">
<header class="bg-slate-900 p-4 border-b border-slate-800 flex justify-between">
    <h1 class="text-xl font-bold text-blue-400">Upload Foto</h1>
        <a href="index.php" class="bg-slate-800 hover:bg-slate-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-all">← Beranda</a>
</header>
<main class="flex items-center justify-center p-6 mt-10">
    <form action="tambah_foto.php" method="POST" enctype="multipart/form-data" class="w-full max-w-lg bg-slate-900 p-8 rounded-2xl border border-slate-800">
        <div class="space-y-6">
            <div>
                <label class="block text-sm text-slate-400 mb-2">Pilih Foto</label>
                <input type="file" name="lokasi_file" required class="w-full text-sm text-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-2">Judul Foto</label>
                <input type="text" name="judul_foto" required class="w-full bg-slate-800 border border-slate-700 rounded-lg py-3 px-4 outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-2">Deskripsi</label>
                <textarea name="deskripsi_foto" rows="4" class="w-full bg-slate-800 border border-slate-700 rounded-lg py-3 px-4 outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>
            <button type="submit" name="upload" class="w-full bg-blue-600 hover:bg-blue-700 font-bold py-3 rounded-lg transition-all">Unggah Sekarang</button>
        </div>
    </form>
</main>
</body>
</html>