<?php
session_start();
include_once "connection.php";

$user = $_POST['user'] ?? '';
$pass = $_POST['pass'] ?? '';

if ($user != '' && $pass != '') {
    $data = mysqli_query($connection, "SELECT * FROM akun WHERE username = '$user' AND password = '$pass'");
    if (mysqli_num_rows($data) > 0) {
        $fetch = mysqli_fetch_row($data);
        $_SESSION['login'] = true;
        $_SESSION['userid'] = $fetch['0'];
        header('Location:dashboard.php');
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
    <!-- Icon -->
    <link rel="shortcut icon" href="assets/img/virus-blue.png" type="image/x-icon">
    <!-- Primary Meta Tags -->
    <title>Coronavirus Global & Indonesia Live Data</title>
    <meta name="title" content="Coronavirus Global & Indonesia Live Data">
    <meta name="description" content="Informasi data terbaru mengenai kasus Virus Corona di seluruh dunia. Data di website covid.magerin.xyz akan selalu di update secara otomatis dan berasal dari Johns Hopkins University">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://covid.magerin.xyz/">
    <meta property="og:title" content="Coronavirus Global & Indonesia Live Data">
    <meta property="og:description" content="Informasi data terbaru mengenai kasus Virus Corona di seluruh dunia. Data di website covid.magerin.xyz akan selalu di update secara otomatis dan berasal dari Johns Hopkins University">
    <meta property="og:image" content="assets/img/virus-blue.png">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://covid.magerin.xyz/">
    <meta property="twitter:title" content="Coronavirus Global & Indonesia Live Data">
    <meta property="twitter:description" content="Informasi data terbaru mengenai kasus Virus Corona di seluruh dunia. Data di website covid.magerin.xyz akan selalu di update secara otomatis dan berasal dari Johns Hopkins University">
    <meta property="twitter:image" content="assets/img/virus-blue.png">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-blue shadow">
        <div class="container-md">
            <a class="navbar-brand" href="#">#PAKAIMASKER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home"><i class="fas fa-home-lg-alt"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#tentangCovid"><i class="fas fa-question"></i> Tentang Covid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#pencegahan"><i class="far fa-stethoscope"></i> Pencegahan Covid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#grafik"><i class="fas fa-chart-bar"></i> Grafik Kasus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#tabelKasus"><i class="fad fa-table"></i> Kasus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#tabelRs"><i class="fad fa-table"></i> Rumah Sakit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active <?= $_SESSION['login'] == true ? '' : 'd-none' ?>" aria-current="page" href="dashboard.php"><i class="fas fa-tachometer-alt-slowest"></i> Dashboard</a>
                        <a role="button" class="nav-link active <?= $_SESSION['login'] == true ? 'd-none' : '' ?>" data-bs-toggle="modal" data-bs-target="#login"><i class="fas fa-sign-in"></i> Login</a>
                    </li>
                    <li class="nav-item  <?= $_SESSION['login'] == true ? '' : 'd-none' ?>">
                        <a class="nav-link active" aria-current="page" href="logout.php"><i class="fas fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <button type="button" class="btn bg-blue text-white btn-floating btn-lg" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>
    <main>
        <div class="p-5 mb-4 bg-blue" id="home">
            <div class="container-xxl py-5 mb-5">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col-md-6 col-12">
                        <h1 class="display-5 fw-bold text-white">Covid 19 Live Tracker</h1>
                        <p class="text-white">Informasi data terbaru mengenai kasus Virus Corona di seluruh dunia. Data di website covid.magerin.xyz akan selalu di update secara otomatis dan berasal dari Johns Hopkins University.</p>
                    </div>
                    <div class="col-md-6 col-12">
                        <img src="assets/img/Covid-illustration-552px_0.png" alt="covid icon" class="img-fluid img-header">
                    </div>
                </div>
            </div>
        </div>
        <div class="container col-md-12 col-12 col mb-5 data-covid">
            <div class="shadow p-3 bg-white card-banner">
                <div class="py-3">
                    <div class="row g-4 justify-content-center">
                        <div class="col-lg">
                            <div class="row gx-1">
                                <div class="col-auto">
                                    <img src="assets/img/smile.png" alt="Sembuh" class="rounded-circle" width="70">
                                </div>
                                <div class="col">
                                    <h4>Sembuh</h4>
                                    <p id="sembuh"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="row gx-1">
                                <div class="col-auto">
                                    <img src="assets/img/sick.png" alt="Dirawat" class="rounded-circle mx-1" width="70">
                                </div>
                                <div class="col-6">
                                    <h4>Dirawat</h4>
                                    <p id="dirawat">Total: </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="row gx-1">
                                <div class="col-auto">
                                    <img src="assets/img/sad.png" alt="Positif" class="rounded-circle" width="70">
                                </div>
                                <div class="col">
                                    <h4>Positif</h4>
                                    <p id="positif"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="row gx-1">
                                <div class="col-auto">
                                    <img src="assets/img/cry.png" alt="Meninggal" class="rounded-circle" width="70">
                                </div>
                                <div class="col">
                                    <h4>Meninggal</h4>
                                    <p id="meninggal">Total: 3,211,078</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p id="lastUpdate" class="text-muted text-center lastUpdate"></p>
            </div>
        </div>
        <div class="container mb-5" id="tentangCovid">
            <h2 class="text-center mb-5">Yang harus kamu ketahui</h2>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <img src="assets/img/index1.svg" alt="gambar 1" class="img-fluid">
                </div>
                <div class="col">
                    <h4>Apa itu COVID-19 ?</h4>
                    <p>COVID-19 adalah penyakit yang disebabkan oleh virus severe acute respiratory syndrome coronavirus 2 (SARS-CoV-2). COVID-19 dapat menyebabkan gangguan sistem pernapasan, mulai dari gejala yang ringan seperti flu, hingga infeksi paru-paru, seperti pneumonia. COVID-19 (coronavirus disease 2019) adalah jenis penyakit baru yang disebabkan oleh virus dari golongan coronavirus, yaitu SARS-CoV-2 yang juga sering disebut virus Corona.</p>
                    <h4>Gejala</h4>
                    <p> Gejala awal infeksi COVID-19 bisa menyerupai gejala flu, yaitu demam, pilek, batuk kering, sakit tenggorokan, dan sakit kepala. Setelah itu, gejala dapat hilang dan sembuh atau malah memberat. Penderita dengan gejala yang berat bisa mengalami demam tinggi, batuk berdahak atau berdarah, sesak napas, dan nyeri dada.</p>
                    <h4>Cara Penularan</h4>
                    <p>Seseoarang dapat terinfeksi dari penderita COVID-19. Virus ini menyebar melalui tetesan kecil (droplet) dari hidung atau mulut saat batuk atau bersin. Droplet tersebut kemudian jatuh pada benda disekitarnya. Dan ketika ada orang lain yang menyentuh benda yang sudah terkontaminasi dengan droplet tersebut, lalu orang itu menyentuh mata, hidung ataupun mulut, maka orang tersebut dapat terinfeksi COVID-19. Seseoarang juga dapat terinfeksi COVID-19 ketika tanpa sengaja menghirup droplet dari penderita.</p>
                </div>
            </div>
        </div>
        <div class="container mb-5" id="pencegahan">
            <h2 class="text-center mb-5">Bagaimana Cara Mencegahnya?</h2>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <img src="assets/img/index2.svg" alt="gambar 1" class="img-fluid">
                </div>
                <div class="col">
                    <h4>Cara Pencegahan</h4>
                    <ol>
                        <li>Cuci Tangan secara rutin menggunakan air dan sabun atau cairan pembersih tangan berbahan alkohol</li>
                        <li>Selalu jaga jarak aman. Terutama dengan orang yang batuk atau bersin.</li>
                        <li>Mengenakan masker jika pembatasan fisik tidak memungkinkan</li>
                        <li>Jangan sentuk mata, hidung atau mulut</li>
                        <li>Saat batuk atau bersin, tutup mulut dan hidung dengan lengan atau tisu</li>
                        <li>Jangan keluar rumah jika tidak ada kepentingan mendesak atau jika merasa tidak enak badan</li>
                        <li>Jika demam, batuk atau kesulatan bernapas segera cari bantuan medis.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container mb-5" id="grafik">
            <h2 class="card-title text-center mb-4">Grafik Kasus Coronavirus di Indonesia</h2>
            <div class="shadow p-3 bg-white justify-content-center">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="container mb-5" id="tabelKasus">
            <h2 class="card-title text-center mb-4">Data Kasus Coronavirus di Indonesia Berdasarkan Provinsi</h2>
            <div class="shadow p-3 bg-white justify-content-center">
                <div class="table-responsive">
                    <table id="kasus" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Provinsi</th>
                                <th>Sembuh</th>
                                <th>Positif</th>
                                <th>Meninggal</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="container mb-5" id="tabelRs">
            <h2 class="card-title text-center mb-4">Data Rumah Sakit Rujukan Coronavirus di Indonesia Berdasarkan Provinsi</h2>
            <div class="shadow p-3 bg-white justify-content-center">
                <div class="table-responsive">
                    <table id="rs" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama RS</th>
                                <th>Alamat</th>
                                <th>Wilayah</th>
                                <th>Kontak</th>
                                <th>Provinsi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-blue text-white">
                    <div class="modal-header ">
                        <h5 class="modal-title" id="staticBackdropLabel">Login Admin</h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body bg-white text-body">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input class="form-control" type="text" name="user" id="user" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" name="pass" id="pass" placeholder="Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn bg-primary text-white">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container-fluid">
            <p class="text-center text-muted text-white">Copyright &copy; <?= date('Y') ?> Muhammad Novel. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/data.js?v=<?= time() ?>"></script>
</body>

</html>