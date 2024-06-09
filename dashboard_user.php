<?php
include 'rental/database.php';

$queryKomik = $db->query('SELECT * FROM data_komik ORDER BY id DESC');
$queryDVD = $db->query('SELECT * FROM data_dvd ORDER BY id DESC');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Komik dan DVD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }

        .hero {
            background-color: #f8f9fa;
            padding: 40px 0;
            margin-bottom: 40px;
            margin-top: 50px;
        }

        .hero h1 {
            color: #343a40;
            font-weight: 700;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #8c908c;
        }

        .card-body {
            padding: 15px;
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
            background-color: #8c8c8c;
        }

        hr {
            border: 1px solid #ceb8a4;
        }

        .see-more-btn {
            margin-top: 20px;
            background-color: #ceb8a4; 
            border-color: #ceb8a4; 
            color: #fff;
        }

    </style>
</head>
<body>
    <?php include 'layout/navbarUser.php'?>

    <div class="hero text-center">
        <h1>Selamat Datang di RentaLIN!</h1>
    </div>

    <div class="container">
        
        <div class="content" id="komik">
            <h3>Daftar Komik</h3>
            <hr>
            <div class="row">
                <?php while ($row = $queryKomik->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="<?php echo htmlspecialchars($row['gambar']) ?>" class="img-thumbnail" alt="Cover Komik">
                                </div>
                                <div class="col-md-7">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['judul']) ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($row['genre']) ?></h6>
                                    <p class="card-text">Stok: <?php echo htmlspecialchars($row['stok']) ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars($row['deskripsi']) ?></p>
                                    <a href="booking_komik.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Book</a>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="text-end"> 
                <a href="user_komik.php" class="btn btn-secondary see-more-btn" id="seeMoreKomik">See More Komik</a>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
      
        <div class="content" id="dvd">
            <h3>Daftar DVD</h3>
            <hr>
            <div class="row">
                <?php while ($row = $queryDVD->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="<?php echo htmlspecialchars($row['gambar']) ?>" class="img-thumbnail" alt="Cover Komik">
                                </div>
                                <div class="col-md-7">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['judul']) ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($row['genre']) ?></h6>
                                    <p class="card-text">Stok: <?php echo htmlspecialchars($row['stok']) ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars($row['deskripsi']) ?></p>
                                    <a href="booking_dvd.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Book</a>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="text-end">
                <a href="user_dvd.php" class="btn btn-secondary see-more-btn" id="seeMoreDVD">See More DVD</a>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
