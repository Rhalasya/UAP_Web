<?php
include 'rental/database.php';

// Fetch booking data with comic information
$query = "
    SELECT booking_komik.id AS booking_id, booking_komik.nama_perental, data_komik.judul, booking_komik.jumlah, booking_komik.booking_date, booking_komik.status 
    FROM booking_komik 
    JOIN data_komik ON booking_komik.id = data_komik.id 
    ORDER BY booking_komik.booking_date DESC
";


$queryBookings = $db->query($query);

if (!$queryBookings) {
    die('Query Error: ' . $db->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Booking Komik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #333;
            padding-top: 20px;
            z-index: 1; 
        }

        .sidebar h2 {
            color: white;
            text-align: center;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
            text-align: center;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #575757;
        }
    .index-container {
        margin-left: 0px; 
            padding: 20px;
            padding-left: 20px; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            position: relative;
            overflow-y: auto; 
}
.content {
            background-color: #DCD2C8;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1210px; 
        }

        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color : #8f8681;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f5f1ea;
        }

        td {
            white-space: nowrap; 
        }

        td:nth-child(6) { 
            min-width: 150px; 
            text-align: center; 
        }
        .btn-custom {
        color: #000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #ceb8a4; /* Bootstrap primary color */
}
        h3{
            text-align : center;
            font-weight : bold;
            color: #ceb8a4;
        }
    </style>
</head>
<body>
    <?php include 'layout/sidebar.php'; ?>

    <div class="container-fluid">
        <div class="index-container">
            <div class="content">
                <h3>Transaksi Komik RentaL IN</h3>
                <hr>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perental</th>
                            <th>Judul Komik</th>
                            <th>Jumlah</th>
                            <th>Tanggal Booking</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($queryBookings->num_rows > 0): ?>
                            <?php 
                            $no = 1;
                            while ($row = $queryBookings->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_perental']); ?></td>
                                    <td><?php echo htmlspecialchars($row['judul']); ?></td>
                                    <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                                    <td>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $row['booking_id'] ?>">Hapus</button>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateStatus<?= $row['booking_id'] ?>">Update Status</button>
        
                                    </td>
                                </tr>

                                <!-- Modal Delete -->
                                <div class="modal fade" id="modalDelete<?= $row['booking_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Yakin ingin hapus Data Booking?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="crud_laporan_komik.php">
                                        <input type="hidden" name="id" value="<?= $row['booking_id'] ?>">

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Perental</label>
                                                        <input type="text" class="form-control" name="nama_perental" value="<?= $row['nama_perental'] ?>" placeholder="Nama Perental" readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Judul</label>
                                                        <input type="text" class="form-control" name="judul" value="<?= $row['judul'] ?>" placeholder="Judul Komik" readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Jumlah</label>
                                                        <input type="text" class="form-control" name="jumlah" value="<?= $row['jumlah'] ?>" placeholder="Jumlah Komik" readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal Booking</label>
                                                        <input type="text" class="form-control" name="booking_date" value="<?= $row['booking_date'] ?>" placeholder="Tanggal Booking" readonly>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="delete">Ya</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                <!-- Akhir Modal delete -->

                                 <!-- Modal Update Status -->
                                <div class="modal fade" id="modalUpdateStatus<?= $row['booking_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateStatusLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="updateStatusLabel">Update Status Booking</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="crud_laporan_komik.php">
                                                <input type="hidden" name="id" value="<?= $row['booking_id'] ?>">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Status Booking</label>
                                                        <select class="form-control" name="status">
                                                            <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                            <option value="confirmed" <?= $row['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="update_status">Update</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
            <!-- Akhir Modal Update Status -->
                                <?php $no++; ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">Tidak ada data booking komik yang ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>