<?php
include './config/koneksi.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Galeri Foto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .modal { transition: opacity 0.3s ease; }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">
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
                    <a href="index.php" class="text-sm font-medium text-blue-600 transition-colors">Beranda</a>
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
                <a href="index.php" class="text-base font-medium text-blue-600 block py-2">Beranda</a>
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

<main class="p-4 md:p-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
        <?php
        $query = mysqli_query($koneksi, "SELECT foto.*, users.nama FROM foto INNER JOIN users ON foto.user_id = users.id_user ORDER BY foto.foto_id DESC");
        while($row = mysqli_fetch_assoc($query)) :
            $f_id = $row['foto_id'];
            $q_like = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM like_foto WHERE foto_id='$f_id'");
            $res_like = mysqli_fetch_assoc($q_like);
            $jml_like = $res_like['total'];
        ?>
        <div class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:shadow-xl transition-all cursor-pointer group flex flex-col" 
            onclick="openModal('<?php echo $row['lokasi_file']; ?>', '<?php echo addslashes($row['judul_foto']); ?>', '<?php echo addslashes($row['deskripsi_foto']); ?>', '<?php echo addslashes($row['nama']); ?>', '<?php echo $jml_like; ?>')">
            
            <div class="relative overflow-hidden aspect-square">
                <img src="upload/<?php echo $row['lokasi_file']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            
            <div class="p-4 flex flex-col flex-1">
                <h3 class="font-bold truncate text-gray-800"><?php echo $row['judul_foto']; ?></h3>
                <p class="text-gray-500 text-xs mb-4 flex items-center gap-1 mt-1 flex-1">
                    <i data-lucide="user" class="w-3 h-3"></i> @<?php echo $row['nama']; ?>
                </p>
                <div class="flex justify-between items-center border-t pt-3 mt-auto">
                    <?php if (!isset($_SESSION['user_id'])) : ?>
                        <button type="button" onclick="alertLogin(event)" class="flex items-center gap-1.5 text-gray-400 hover:text-blue-600 transition-colors">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                            <span class="text-sm font-medium"><?php echo $jml_like; ?></span>
                        </button>
                    <?php else : ?>
                        <a href="proses_like.php?foto_id=<?php echo $row['foto_id']; ?>" class="flex items-center gap-1.5 text-gray-600 hover:text-red-500 transition-colors" onclick="event.stopPropagation();">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                            <span class="text-sm font-medium"><?php echo $jml_like; ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</main>

<div id="modal" class="modal opacity-0 pointer-events-none fixed inset-0 flex items-center justify-center z-[60] p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl z-[70] overflow-hidden flex flex-col md:flex-row border border-gray-100">
        <div class="w-full md:w-3/5 bg-gray-100 flex items-center justify-center">
            <img id="modal-img" src="" class="max-w-full max-h-[70vh] md:max-h-[85vh] object-contain">
        </div>
        <div class="w-full md:w-2/5 p-6 md:p-8 flex flex-col bg-white max-h-[50vh] md:max-h-[85vh] overflow-y-auto">
            <div class="flex-1">
                <div class="flex justify-between items-start mb-6">
                    <h2 id="modal-title" class="text-2xl font-bold text-gray-800 leading-tight"></h2>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <div class="flex items-center gap-2 mb-6 p-3 bg-blue-50 rounded-lg">
                    <i data-lucide="circle-user" class="text-blue-600 w-5 h-5"></i>
                    <p class="text-blue-700 font-semibold text-sm" id="modal-user"></p>
                </div>

                <div class="space-y-2">
                    <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Deskripsi</p>
                    <p class="text-gray-600 text-sm leading-relaxed break-words" id="modal-desc"></p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between items-center">
                <div class="flex items-center gap-2 text-red-500">
                    <i data-lucide="heart" class="w-5 h-5 fill-current"></i>
                    <span class="font-bold" id="modal-likes"></span>
                </div>
                <button onclick="closeModal()" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-sm font-bold transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/script.js?v=<?php echo time(); ?>"></script>
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
</script>
</body>
</html>