<?php
session_start();
include './config/koneksi.php';

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
    <title>Edit Foto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-white flex justify-center p-10">
    <form method="POST" class="bg-slate-900 p-8 rounded-xl border border-slate-800 w-full max-w-md">
        <h2 class="text-xl font-bold mb-6">Edit Info Foto</h2>
        <div class="space-y-4">
            <input type="text" name="judul_foto" value="<?php echo $row['judul_foto']; ?>" class="w-full p-3 bg-slate-800 rounded">
            <textarea name="deskripsi_foto" rows="4" class="w-full p-3 bg-slate-800 rounded"><?php echo $row['deskripsi_foto']; ?></textarea>
            <button type="submit" name="update" class="w-full bg-blue-600 py-3 rounded font-bold">Simpan Perubahan</button>
        </div>
    </form>
</body>
</html>