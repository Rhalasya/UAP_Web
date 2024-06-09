<?php
require 'rental/database.php';

$id = $_GET['id'];
$sql = "SELECT * FROM data_komik WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);

        // Periksa apakah file sebenarnya adalah gambar
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if($check !== false) {
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $gambar_path = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $gambar_path = $produk['gambar'];
    }

    $sql = "UPDATE data_komik SET judul = ?, genre = ?, stok = ?, deskripsi = ?, gambar = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssissi', $judul, $genre, $stok, $deskripsi, $gambar_path, $id);
    $stmt->execute();

    header("Location: indexkomik.php");
    exit();
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
                    <label for="judul" class="form-label">Judul Komik:</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo htmlspecialchars($produk['judul']); ?>">
                </div>
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre:</label>
                    <select class="form-control" id="genre" name="genre">
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
                    <input type="text" class="form-control" id="stok" name="stok" value="<?php echo htmlspecialchars($produk['stok']); ?>"> 
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Cover Komik:</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                    <img src="<?php echo htmlspecialchars($produk['gambar']); ?>" alt="Gambar Lama" width="100">
                </div>
                <input type="submit" value="Ubah" class="btn btn-custom">
            </form>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
