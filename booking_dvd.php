<?php
include 'rental/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_perental = $_POST['nama_perental'];
    $dvd_id = $_POST['dvd_id'];
    $jumlah = $_POST['jumlah'];

    // Get comic details
    $dvd_query = $db->query("SELECT * FROM data_dvd WHERE id = $dvd_id");
    if (!$dvd_query) {
        die('Query Error: ' . $db->error);
    }
    $dvd = $dvd_query->fetch_assoc();

    // Check if the requested amount is available
    if ($dvd['stok'] < $jumlah) {
        die('Error: Stok tidak mencukupi.');
    }

    // Insert booking data
    $insert_query = $db->prepare("INSERT INTO booking_dvd (nama_perental, id, jumlah) VALUES (?, ?, ?)");
    if (!$insert_query) {
        die('Prepare Error: ' . $db->error);
    }
    $insert_query->bind_param("sii", $nama_perental, $dvd_id, $jumlah);
    if (!$insert_query->execute()) {
        die('Execute Error: ' . $insert_query->error);
    }

    // Reduce stock
    $new_stock = $dvd['stok'] - $jumlah;
    $update_query = $db->prepare("UPDATE data_dvd SET stok = ? WHERE id = ?");
    if (!$update_query) {
        die('Prepare Error: ' . $db->error);
    }
    $update_query->bind_param("ii", $new_stock, $dvd_id);
    if (!$update_query->execute()) {
        die('Execute Error: ' . $update_query->error);
    }

    echo "<script>
        alert('Booking berhasil!');
        window.location.href = 'dashboard_user.php';
    </script>";
    exit();
}

// Fetch comic details to display in the form
$dvd_id = $_GET['id'];
$dvd_query = $db->query("SELECT * FROM data_dvd WHERE id = $dvd_id");
if (!$dvd_query) {
    die('Query Error: ' . $db->error);
}
$dvd = $dvd_query->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Komik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'layout/navbarUser.php'?>
<div class="container">
    <h3>Booking Komik: <?php echo htmlspecialchars($dvd['judul']); ?></h3>
    <form method="POST" action="booking_dvd.php">
        <input type="hidden" name="dvd_id" value="<?php echo $dvd_id; ?>">
        <div class="mb-3">
            <label for="nama_perental" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama_perental" name="nama_perental" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Komik yang Dipinjam</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1" max="<?php echo $dvd['stok']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Booking</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
