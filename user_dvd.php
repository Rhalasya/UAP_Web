<?php
include 'rental/database.php';

$queryDVD = $db->query('SELECT * FROM data_dvd ORDER BY id DESC');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar DVD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            background-color: #fff;
        }

        .hero {
            background-color: #f8f9fa;
            padding: 40px 0;
            margin-bottom: 40px;
        }

        .hero h1 {
            color: #343a40;
            font-weight: 700;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #f5f1ea;
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-title {
            font-weight: bold;
        }

        .card-text {
            color: #8f8681;
        }

        .btn-custom {
            color: #000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ceb8a4;
        }

        .btn-coklat {
            background-color: #8B4513;
            color: white;
        }

        .btn-coklat:hover {
            background-color: #A0522D;
            color: white;
        }

        hr {
            border: 1px solid #ceb8a4;
        }

        table.dataTable {
            border-collapse: collapse !important;
            text-align: center;
        }

        table.dataTable thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            text-align: center;
        }

        table.dataTable tbody tr {
            background-color: #fff;
            text-align: center;
        }

        table.dataTable tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        table.dataTable td {
            text-align: center;
            vertical-align: middle;
        }

        table.dataTable .btn {
            display: block;
            margin: auto;
        }

        .container{
            margin-top:100px;
        }
    </style>
</head>
<body>
    <?php include 'layout/navbarUser.php'?>

    <div class="container">
        <div class="content" id="dvd">
            <h3>Daftar DVD</h3>
            <hr>
            <table id="dvdTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Genre</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $queryDVD->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['judul']) ?></td>
                            <td><?php echo htmlspecialchars($row['genre']) ?></td>
                            <td><?php echo htmlspecialchars($row['stok']) ?></td>
                            <td><?php echo htmlspecialchars($row['deskripsi']) ?></td>
                            <td><a href="booking_dvd.php?id=<?php echo $row['id'] ?>" class="btn btn-coklat">Book</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dvdTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/Indonesian.json"
                }
            });
        });
    </script>
</body>
</html>
