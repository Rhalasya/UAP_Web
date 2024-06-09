<?php
include 'rental/database.php';

$query = $db->query('SELECT * FROM data_komik ORDER BY id DESC');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Komik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .card-img-top {
        max-height: 200px;
        object-fit: cover;
    }
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
<body>
<?php include 'layout/sidebar.php' ?>
<div class="container-fluid">
    <div class="index-container">
        <div class="content">
            <h3>Daftar Komik RentaLIN</h3>
            <hr>
            <a href="createkomik.php" class="btn btn-custom mb-3">+ Tambah Produk</a>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Genre</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while ($row = $query->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><img src="<?php echo htmlspecialchars($row['gambar']) ?>" class="img-thumbnail" width="100" alt="Gambar Komik"></td>
                            <td><?php echo htmlspecialchars($row['judul']) ?></td>
                            <td><?php echo htmlspecialchars($row['genre']) ?></td>
                            <td><?php echo htmlspecialchars($row['stok']) ?></td>
                            <td><?php echo htmlspecialchars($row['deskripsi']) ?></td>
                            <td>
                                <a href="updatekomik.php?id=<?php echo $row['id'] ?>" class="btn btn-success">Edit</a>
                                <a href="deletekomik.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                            </td>
                        </tr>
                        <?php $no++; endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>