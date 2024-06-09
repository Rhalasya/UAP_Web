<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />

    <style>
        .navbar-custom {
            background-color: #c6aa9d !important; /* Menggunakan !important untuk memaksa perubahan warna */
        }
        .navbar-custom .nav-link {
            color: #53655c !important;
            font-weight: 700;
            border-color: #e5e8eb;
            text-shadow: 2px 2px 4px rgba(210, 202, 202, 0.914);
        }
        .navbar-fixed {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030; /* Menentukan z-index agar navbar berada di atas elemen lain */
        }
        body {
            padding-top: 70px; /* Menambahkan padding pada body agar konten tidak tertutup navbar */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom navbar-fixed">
<div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="./assets/logorental.png" alt="" width="160" height="100" class="">
        RentaL IN
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="dashboard_user.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#komik">Commic</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#dvd">DVD</a>
            </li>
        </ul>
        
    </div>
</div>
</nav>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
      crossorigin="anonymous"
    ></script>
</body>
</html>
