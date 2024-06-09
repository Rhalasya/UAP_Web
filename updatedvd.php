<?php
require 'rental/database.php';

$id = $_GET['id'];
$sql = "SELECT * FROM data_dvd WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $id); // Bind the id parameter
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc(); // Fetch the result as an associative array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload gambar baru jika ada
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);

        // Periksa apakah file sebenarnya adalah gambar
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            // Pastikan direktori upload ada dan dapat ditulis
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                // Perbarui data termasuk gambar
                $sql = "UPDATE data_dvd SET judul = ?, genre = ?, stok = ?, deskripsi = ?, gambar = ? WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('ssissi', $judul, $genre, $stok, $deskripsi, $target_file, $id); // Bind the parameters for the update query
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    } else {
        // Perbarui data tanpa gambar
        $sql = "UPDATE data_dvd SET judul = ?, genre = ?, stok = ?, deskripsi = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssisi', $judul, $genre, $stok, $deskripsi, $id); // Bind the parameters for the update query
    }

    if ($stmt->execute()) {
        header("Location: indexdvd.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylekomik.css">
</head>
<body>
<?php include 'layout/sidebar.php' ?>
<div class="container">
    <div class="index-container">
        <div class="form-container">
        <h3>Edit Produk</h3>
        <hr>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul DVD:</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo htmlspecialchars($produk['judul']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre:</label>
                    <select class="form-control" id="genre" name="genre" required>
                        <option value="">Pilih</option>
                        <option value="<?php echo htmlspecialchars($produk['genre']); ?>" selected><?php echo htmlspecialchars($produk['genre']); ?></option>
                        <option value="Romance">Romance</option>
                        <option value="Action">Action</option>
                        <option value="Sci-fi">Sci-Fi</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Horor">Horor</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Mysteri">Mystery</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok:</label>
                    <input type="text" class="form-control" id="stok" name="stok" value="<?php echo htmlspecialchars($produk['stok']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Cover DVD:</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                    <?php if (!empty($produk['gambar'])): ?>
                        <img src="<?php echo $produk['gambar']; ?>" alt="Cover DVD" style="width:100px; margin-top:10px;">
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-custom">Ubah</button>
            </form>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
