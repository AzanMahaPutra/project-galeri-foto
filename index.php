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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .modal { transition: opacity 0.3s ease; }
    </style>
</head>
<body class="bg-slate-950 text-white min-h-screen">
<header class="bg-slate-900 p-4 shadow-md flex justify-between items-center sticky top-0 z-50 border-b border-slate-800">
    <h1 class="text-2xl font-bold text-blue-400">Galeri Foto</h1>
    <div class="flex items-center gap-4">
        <?php if (isset($_SESSION['nama'])) : ?>
            <a href="index.php" class="text-sm text-slate-400 hover:text-white transition-colors">Beranda</a>
            <a href="foto_saya.php" class="text-sm text-slate-400 hover:text-white transition-colors">Foto Saya</a>
            <span class="text-sm text-slate-400 ml-2">| Hi, <b><?php echo $_SESSION['nama']; ?></b></span> 
            <a href="upload.php" class="bg-blue-600 py-2 px-4 rounded text-sm font-bold hover:bg-blue-700 transition-all">+ Upload</a>
            <a href="logout.php" class="bg-red-500 py-2 px-4 rounded text-sm font-bold hover:bg-red-600 transition-all">Logout</a>
        <?php else : ?>
            <a class="bg-blue-600 py-2 px-6 rounded font-bold hover:bg-blue-700 transition-all" href="login.php">Login</a>
        <?php endif; ?>
    </div>
</header>
<main class="p-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php
        $query = mysqli_query($koneksi, "SELECT foto.*, users.nama FROM foto INNER JOIN users ON foto.user_id = users.id_user ORDER BY foto.foto_id DESC");
        while($row = mysqli_fetch_assoc($query)) :
            $f_id = $row['foto_id'];
            $q_like = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM like_foto WHERE foto_id='$f_id'");
            $res_like = mysqli_fetch_assoc($q_like);
            $jml_like = $res_like['total'];
        ?>
        <div class="bg-slate-900 rounded-xl overflow-hidden border border-slate-800 hover:border-blue-500 transition-all cursor-pointer group">
            <div onclick="openModal('<?php echo $row['lokasi_file']; ?>', '<?php echo addslashes($row['judul_foto']); ?>', '<?php echo addslashes($row['deskripsi_foto']); ?>', '<?php echo $row['nama']; ?>', '<?php echo $jml_like; ?>')">
                <img src="upload/<?php echo $row['lokasi_file']; ?>" class="w-full h-48 object-cover group-hover:scale-105 transition-transform">
            </div>
            <div class="p-4">
                <h3 class="font-bold truncate text-slate-200"><?php echo $row['judul_foto']; ?></h3>
                <p class="text-slate-500 text-xs mb-3">@<?php echo $row['nama']; ?></p>
                <div class="flex justify-between items-center">
                    <a href="proses_like.php?foto_id=<?php echo $row['foto_id']; ?>" class="text-red-500 text-sm hover:scale-110 transition-all">
                        ❤️ <span class="text-slate-300"><?php echo $jml_like; ?> Like</span>
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</main>

<div id="modal" class="modal opacity-0 pointer-events-none fixed inset-0 flex items-center justify-center z-50 p-4">
    <div class="absolute inset-0 bg-black opacity-80" onclick="closeModal()"></div>
    <div class="bg-slate-900 w-full max-w-4xl rounded-2xl shadow-2xl z-50 overflow-hidden border border-slate-700 flex flex-col md:flex-row">
        <div class="md:w-3/5">
            <img id="modal-img" src="" class="w-full h-full object-cover max-h-[500px]">
        </div>
        <div class="md:w-2/5 p-8 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <h2 id="modal-title" class="text-2xl font-bold"></h2>
                    <button onclick="closeModal()" class="text-slate-400 hover:text-white text-2xl">&times;</button>
                </div>
                <p class="text-blue-400 text-sm font-semibold mb-4" id="modal-user"></p>
                <p class="text-slate-300 text-sm leading-relaxed" id="modal-desc"></p>
            </div>
            <div class="mt-8 pt-4 border-t border-slate-800 flex justify-between items-center">
                <span class="text-red-500 font-bold" id="modal-likes"></span>
                <button onclick="closeModal()" class="bg-slate-800 px-4 py-2 rounded text-sm">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>
</body>
</html>