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
    <title>Manajemen Rental Komik</title>
    <link rel="stylesheet" href="style.css">
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

        .carousel-item {
            display: flex;
            justify-content: center;
        }

        .carousel-item .card {
            max-width: 18rem;
            margin: 10px;
        }

    </style>
</head>
<body>
    <?php include 'layout/sidebar.php'?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
   
            </div>
            <div class="col-md-9">
                <h3>Daftar Komik</h3>
                <hr>
                <div id="komikCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php $active = true; while ($row = $queryKomik->fetch_assoc()): ?>
                            <div class="carousel-item <?php if ($active) { echo 'active'; $active = false; } ?>">
                                <div class="card">
                                    <img src="<?php echo htmlspecialchars($row['gambar']) ?>" class="card-img-top" alt="Cover Komik">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['judul']) ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#komikCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#komikCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <br>
                <br>

                <h3>Daftar DVD</h3>
                <hr>
                <div id="dvdCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php $active = true; while ($row = $queryDVD->fetch_assoc()): ?>
                            <div class="carousel-item <?php if ($active) { echo 'active'; $active = false; } ?>">
                                <div class="card">
                                    <img src="<?php echo htmlspecialchars($row['gambar']) ?>" class="card-img-top" alt="Cover DVD">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['judul']) ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#dvdCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#dvdCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
