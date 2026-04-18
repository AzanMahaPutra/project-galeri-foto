<?php
session_start();
include './config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Foto - Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
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

<main class="max-w-6xl mx-auto p-4 md:p-8 mt-2">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                <i data-lucide="folder-open" class="text-blue-600 w-8 h-8"></i> Foto Saya
            </h1>
            <p class="text-gray-500 text-sm mt-1">Kelola koleksi momen yang telah kamu unggah.</p>
        </div>
    </div>

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE user_id='$user_id' ORDER BY foto_id DESC");
    if (mysqli_num_rows($query) > 0) {
        // Simpan data ke array agar bisa digunakan dua kali (Mobile & Desktop) tanpa query ulang
        $all_photos = mysqli_fetch_all($query, MYSQLI_ASSOC);
    ?>

        <div class="grid grid-cols-1 gap-4 md:hidden">
            <?php foreach ($all_photos as $row) : ?>
                <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
                    <div class="flex gap-4 mb-4">
                        <img src="upload/<?php echo $row['lokasi_file']; ?>" class="w-24 h-24 object-cover rounded-xl border">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-800 truncate"><?php echo $row['judul_foto']; ?></h3>
                            <p class="text-xs text-gray-500 line-clamp-2 mt-1"><?php echo $row['deskripsi_foto']; ?></p>
                            <span class="inline-block mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                                <i data-lucide="calendar" class="w-3 h-3 inline mr-1"></i> <?php echo date('d M Y', strtotime($row['tanggal_unggah'])); ?>
                            </span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 pt-3 border-t border-gray-50">
                        <a href="fungsi_edit.php?id=<?php echo $row['foto_id']; ?>" class="flex justify-center items-center gap-2 bg-amber-50 text-amber-600 py-2.5 rounded-xl text-sm font-bold border border-amber-100">
                            <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                        </a>
                        <button onclick="confirmDelete(<?php echo $row['foto_id']; ?>)" class="flex justify-center items-center gap-2 bg-red-50 text-red-600 py-2.5 rounded-xl text-sm font-bold border border-red-100">
                            <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="hidden md:block bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <table class="w-full text-left table-fixed">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="p-4 w-32 text-center">Preview</th>
                        <th class="p-4">Informasi Foto</th>
                        <th class="p-4 w-40">Tanggal</th>
                        <th class="p-4 text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($all_photos as $row) : ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4">
                                <img src="upload/<?php echo $row['lokasi_file']; ?>" class="w-20 h-14 object-cover rounded-lg border shadow-sm mx-auto">
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-gray-800"><?php echo $row['judul_foto']; ?></div>
                                <div class="text-xs text-gray-500 line-clamp-1"><?php echo $row['deskripsi_foto']; ?></div>
                            </td>
                            <td class="p-4 text-sm text-gray-600">
                                <?php echo date('d M Y', strtotime($row['tanggal_unggah'])); ?>
                            </td>
                            <td class="p-4">
                                <div class="flex justify-center gap-2">
                                    <a href="fungsi_edit.php?id=<?php echo $row['foto_id']; ?>" class="flex items-center gap-1 bg-amber-50 text-amber-600 px-3 py-1.5 rounded-lg text-xs font-bold border border-amber-200 hover:bg-amber-500 hover:text-white transition-all">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete(<?php echo $row['foto_id']; ?>)" class="flex items-center gap-1 bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold border border-red-200 hover:bg-red-500 hover:text-white transition-all">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php 
    } else {
        echo "<div class='bg-white p-20 rounded-2xl border border-dashed border-gray-300 text-center text-gray-400'>
                <i data-lucide='image-off' class='w-12 h-12 mx-auto mb-4 opacity-20'></i>
                <p class='font-medium'>Kamu belum memiliki koleksi foto.</p>
                <a href='upload.php' class='text-blue-600 text-sm font-bold underline mt-2 inline-block'>Mulai Unggah Foto</a>
              </div>";
    }
    ?>
</main>

<script>
    lucide.createIcons();

    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus foto ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#9ca3af',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            border: 'none',
            borderRadius: '15px'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'fungsi_delete.php?id=' + id;
            }
        });
    }

    // Toggle Mobile Menu
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