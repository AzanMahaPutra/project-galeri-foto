<?php
session_start();
include './config/koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE foto_id='$id'");
$row = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $judul = $_POST['judul_foto'];
    $desc = $_POST['deskripsi_foto'];
    
    mysqli_query($koneksi, "UPDATE foto SET judul_foto='$judul', deskripsi_foto='$desc' WHERE foto_id='$id'");
    header("Location: foto_saya.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto - Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4 text-gray-800">

    <div class="w-full max-w-lg bg-white p-8 rounded-2xl border border-gray-200 shadow-xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-blue-500"></div>

        <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                <i data-lucide="edit" class="w-6 h-6"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Info Foto</h2>
        </div>

        <form method="POST" class="space-y-6">
            <div class="bg-gray-50 p-2 rounded-xl border border-gray-100 flex justify-center mb-6">
                <img src="upload/<?php echo $row['lokasi_file']; ?>" class="h-40 w-auto rounded-lg object-contain shadow-sm" alt="Preview Foto">
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Judul Foto</label>
                    <input type="text" name="judul_foto" value="<?php echo htmlspecialchars($row['judul_foto']); ?>" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all text-gray-800">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Deskripsi Foto</label>
                    <textarea name="deskripsi_foto" rows="4" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all text-gray-800 resize-none"><?php echo htmlspecialchars($row['deskripsi_foto']); ?></textarea>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <a href="foto_saya.php" class="w-1/3 flex justify-center items-center gap-2 bg-white border border-gray-300 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" name="update" class="w-2/3 flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-sm transition-colors">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        // Render Ikon Lucide
        lucide.createIcons();
    </script>
</body>
</html>