<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 2000000) {
        echo "Maaf, file terlalu besar.";
        $uploadOk = 0;
    }

    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak terunggah.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "File ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " telah diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah File</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <span class="block text-gray-700 text-sm font-bold mb-2">Note: File harus berekstensi .jpg, .jpeg, .png, atau .gif</span>
        <h1 class="text-2xl font-bold mb-4">Unggah File</h1>
        <form action="" method="post" enctype="multipart/form-data" class="mb-6">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="fileToUpload">Pilih file untuk diunggah:</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div>
                <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Unggah File
                </button>
            </div>
        </form>
        <h2 class="text-xl font-bold mb-4">Daftar File yang Diunggah</h2>
        <ul class="list-disc list-inside">
            <?php
            $files = scandir("uploads/");
            foreach ($files as $file) {
                if ($file != "." && $file != ".." && $file != ".gitignore") {
                    echo "<li><a href='uploads/$file' class='text-blue-500 hover:underline'>$file</a></li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>