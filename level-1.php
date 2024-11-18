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
</head>

<body>
    <h1>Unggah File</h1>
    <form action="" method="post" enctype="multipart/form-data">
        Pilih file untuk diunggah:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Unggah File" name="submit">
    </form>
    <h2>Daftar File yang Diunggah</h2>
    <ul>
        <?php
        $files = scandir("uploads/");
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                echo "<li><a href='uploads/$file'>$file</a></li>";
            }
        }
        ?>
    </ul>
</body>

</html>