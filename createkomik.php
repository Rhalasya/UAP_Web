<?php
require 'rental/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    // Check if file is an actual image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO data_komik (judul, genre, stok, deskripsi, gambar) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ssiss", $judul, $genre, $stok, $deskripsi, $target_file);

            // Menjalankan pernyataan yang dipersiapkan
            if ($stmt->execute()) {
                header("Location: indexkomik.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }

    $db->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylekomik.css">
</head>
<body>
<?php include 'layout/sidebar.php' ?>
<div class="container">
    <div class="index-container">
        <div class="form-container">
        <h3>Tambah Produk</h3>
        <hr>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Komik:</label>
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre:</label>
                    <select class="form-control" id="genre" name="genre">
                        <option value="">Pilih</option>
                        <option value="romance">Romance</option>
                        <option value="action">Action</option>
                        <option value="sci-fi">Sci-Fi</option>
                        <option value="comedy">Comedy</option>
                        <option value="horor">Horor</option>
                        <option value="adventure">Adventure</option>
                        <option value="mysteri">Mystery</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok:</label>
                    <input type="text" class="form-control" id="stok" name="stok">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Cover Komik:</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>
                <button type="submit" class="btn btn-custom">Tambah</button>
            </form>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
