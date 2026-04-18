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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload - Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800">
<header class="bg-white p-4 shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto flex flex-wrap justify-between items-center">
        <h1 class="text-2xl font-bold text-blue-600 flex items-center gap-2">
            <i data-lucide="image"></i> Galeri Foto
        </h1>
        
        <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600 hover:text-blue-600 focus:outline-none transition-colors">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

        <div class="hidden md:flex items-center gap-4">
            <?php if (isset($_SESSION['nama'])) : ?>
                <nav class="flex items-center gap-6 mr-4">
                    <a href="index.php" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Beranda</a>
                    <a href="foto_saya.php" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Foto Saya</a>
                    <span class="text-sm text-gray-400">| Hi, <b class="text-gray-800"><?php echo $_SESSION['nama']; ?></b></span> 
                </nav>

                <div class="flex gap-2">
                    <a href="upload.php" class="bg-blue-600 py-2 px-4 rounded-lg text-sm font-semibold text-white hover:bg-blue-700 transition-all flex items-center gap-2">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Upload
                    </a>
                    <a href="logout.php" class="bg-white border border-red-200 py-2 px-4 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50 transition-all flex items-center gap-2">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                    </a>
                </div>
            <?php else : ?>
                <a class="bg-blue-600 py-2 px-6 rounded-lg font-bold text-white hover:bg-blue-700 transition-all" href="login.php">Login</a>
            <?php endif; ?>
        </div>

        <div id="mobile-menu" class="hidden w-full mt-4 pt-4 border-t border-gray-100 flex-col gap-4 md:hidden">
            <?php if (isset($_SESSION['nama'])) : ?>
                <span class="text-sm text-gray-500 mb-2 block">Hi, <b class="text-gray-800"><?php echo $_SESSION['nama']; ?></b></span>
                <a href="index.php" class="text-base font-medium text-gray-600 hover:text-blue-600 block py-2">Beranda</a>
                <a href="foto_saya.php" class="text-base font-medium text-gray-600 hover:text-blue-600 block py-2">Foto Saya</a>
                
                <div class="grid grid-cols-2 gap-3 mt-4">
                    <a href="upload.php" class="flex justify-center items-center gap-2 bg-blue-600 py-2.5 rounded-lg text-sm font-bold text-white">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Upload
                    </a>
                    <a href="logout.php" class="flex justify-center items-center gap-2 bg-white border border-red-200 py-2.5 rounded-lg text-sm font-bold text-red-600">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                    </a>
                </div>
            <?php else : ?>
                <a class="block text-center bg-blue-600 py-3 rounded-lg font-bold text-white mt-2" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main class="max-w-xl mx-auto p-4 md:p-8 mt-4 md:mt-8">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center justify-center gap-2">
            <i data-lucide="upload-cloud" class="text-blue-600 w-8 h-8"></i> Unggah Foto
        </h1>
        <p class="text-gray-500 text-sm mt-2">Bagikan momen terbaikmu ke dalam galeri.</p>
    </div>

    <form action="tambah_foto.php" method="POST" enctype="multipart/form-data" class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm">
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Foto</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i data-lucide="image-plus" class="w-8 h-8 text-gray-400 mb-2"></i>
                            <p class="text-sm text-gray-500"><span class="font-bold text-blue-600">Klik untuk memilih</span> atau seret file ke sini</p>
                        </div>
                        <input type="file" name="lokasi_file" required class="hidden" id="file-upload" onchange="updateFileName(this)">
                    </label>
                </div>
                <p id="file-name" class="text-xs text-center text-gray-500 mt-2 hidden"></p>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Foto</label>
                <input type="text" name="judul_foto" required placeholder="Masukkan judul foto..." class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl py-3 px-4 outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi_foto" rows="4" placeholder="Ceritakan tentang foto ini..." class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl py-3 px-4 outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all resize-none"></textarea>
            </div>
            
            <button type="submit" name="upload" class="w-full flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg">
                <i data-lucide="send" class="w-4 h-4"></i> Unggah Sekarang
            </button>
        </div>
    </form>
</main>

<script>
    lucide.createIcons();

    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');
        });
    }

    function updateFileName(input) {
        const fileNameDisplay = document.getElementById('file-name');
        if (input.files && input.files.length > 0) {
            fileNameDisplay.textContent = 'File terpilih: ' + input.files[0].name;
            fileNameDisplay.classList.remove('hidden');
        } else {
            fileNameDisplay.classList.add('hidden');
        }
    }
</script>
</body>
</html>