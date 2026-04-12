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
    <title>Foto Saya - Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-white p-6 md:p-12">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-blue-400">Kelola Foto Saya</h1>
                <p class="text-slate-500 text-sm mt-1">Lihat, edit, atau hapus koleksi foto pribadi kamu.</p>
            </div>
            <div class="flex gap-3">
                <a href="index.php" class="bg-slate-800 hover:bg-slate-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-all">← Beranda</a>
                <a href="upload.php" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow-lg shadow-blue-600/20 transition-all flex items-center gap-2">+ Upload</a>
            </div>
        </div>

        <div class="overflow-hidden bg-slate-900 rounded-2xl border border-slate-800 shadow-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-800/50 text-slate-400 text-xs uppercase tracking-wider">
                        <th class="p-4 font-bold">Preview</th>
                        <th class="p-4 font-bold">Informasi Foto</th>
                        <th class="p-4 font-bold">Tanggal Unggah</th>
                        <th class="p-4 text-center font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE user_id='$user_id' ORDER BY foto_id DESC"); 
                    if (mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_assoc($query)) :
                    ?>
                    <tr class="hover:bg-slate-800/30 transition-colors">
                        <td class="p-4">
                            <img src="upload/<?php echo $row['lokasi_file']; ?>" class="w-20 h-14 object-cover rounded-lg border border-slate-700">
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-slate-200"><?php echo $row['judul_foto']; ?></div>
                            <div class="text-xs text-slate-500 line-clamp-1"><?php echo $row['deskripsi_foto']; ?></div>
                        </td>
                        <td class="p-4 text-sm text-slate-400">
                            <?php echo date('d M Y', strtotime($row['tanggal_unggah'])); ?>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-center gap-2">
                                <a href="edit_foto.php?id=<?php echo $row['foto_id']; ?>" class="bg-amber-500/10 text-amber-500 border border-amber-500/20 px-3 py-1.5 rounded-md text-xs font-bold hover:bg-amber-500 hover:text-white transition-all">
                                    Edit
                                </a>
                                <a href="hapus_foto.php?id=<?php echo $row['foto_id']; ?>" 
                                   onclick="return confirm('Apakah kamu yakin ingin menghapus foto ini?')" 
                                   class="bg-red-500/10 text-red-500 border border-red-500/20 px-3 py-1.5 rounded-md text-xs font-bold hover:bg-red-500 hover:text-white transition-all">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    } else {
                        echo "<tr><td colspan='4' class='p-12 text-center text-slate-500 italic'>Kamu belum mengunggah foto apapun.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>