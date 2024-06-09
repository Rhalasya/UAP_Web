<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
<?php
$tampil = mysqli_query($db, "SELECT * FROM akunstaff ORDER BY id DESC");
$data = mysqli_fetch_array($tampil);
?>
<div class="sidebar">
        <h2>Hello, <?= $data['username'] ?></h2>
        <hr>
        <ul>
            <li><a href="dashboardStaf.php">Dashboard</a></li>
            <li><a href="indexkomik.php">Daftar Komik</a></li>
            <li><a href="indexdvd.php">Daftar DVD</a></li>
            <li><a href="laporankomik.php">Laporan Komik</a></li>
            <li><a href="laporandvd.php">Laporan DVD</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>