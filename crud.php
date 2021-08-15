<?php
session_start();
include_once "connection.php";

if ($_SESSION['login'] == false) {
    header('location:logout.php');
    die;
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
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
    <!-- icon -->
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-blue fixed-top shadow">
        <div class="container-md">
            <a class="navbar-brand" href="#">#PAKAIMASKER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./#home"><i class="fas fa-home-lg-alt"></i> Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            User Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a role="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tambahSertif"><i class="fas fa-plus"></i> Tambah</a>
                            </li>
                            <li>
                                <a role="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editSertif"><i class="fas fa-edit"></i> Edit</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a role="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hapusSertif"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="logout.php"><i class="fas fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <button type="button" class="btn bg-blue text-white btn-floating btn-lg" id="btn-back-to-top">
            <i class="fas fa-arrow-up"></i>
        </button>
        <div class="p-5 mb-4 bg-blue" id="home">
            <div class="container-xxl mb-5 py-5">
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
                                    <img src="assets/img/smile.png" alt="Sembuh" class="rounded-circle">
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
                                    <img src="assets/img/sick.png" alt="Dirawat" class="rounded-circle mx-1">
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
                                    <img src="assets/img/sad.png" alt="Positif" class="rounded-circle">
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
                                    <img src="assets/img/cry.png" alt="Meninggal" class="rounded-circle">
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
        <div class="container col-md-8 col-10 mb-5">
            <?php
            $id = $_GET['id'];
            $nama = $_GET['nama'];
            $type = $_GET['type'];
            $data = mysqli_query($connection, "SELECT * FROM sertif WHERE nama = '$nama'");
            $fetch = mysqli_fetch_assoc($data);
            if ($type == 'edit') {
            ?>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body bg-white text-body">
                        <div class="mb-3">
                            <label class="form-label">Vaksin Ke</label>
                            <input class="form-control" type="text" name="urut" id="urut" value="<?= $id ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input class="form-control" type="text" name="nama" id="nama" value="<?= $fetch['nama'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Vaksin</label>
                            <input class="form-control" type="date" name="tgl" id="tgl" value="<?= $id == 2 ? $fetch['tanggal2'] : $fetch['tanggal1'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tempat Vaksin</label>
                            <textarea class="form-control" name="tempat" id="tempat" rows="3"><?= $fetch['tempat'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sertivikat Vaksin</label>
                            <input class="form-control" type="file" name="sertif" id="sertif" value="<?= $fetch['gambar2'] ?>">
                        </div>
                    </div>
                    <input type="hidden" name="prefix" id="prefix" value="<?= $nama ?>">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn bg-blue text-white" name="btn" id="btn" value="edit">Submit</button>
                        <a href='dashboard.php' class="btn bg-blue text-white">Back</a>
                    </div>
                </form>
            <?php } else if ($type == 'delete') { ?>
                <form action="upload.php" method="POST">
                    <h3 class="mb-5 text-center text-muted">Apakah anda yakin ingin menghapus data <?= $nama ?> ?</h3>
                    <input type="hidden" name="prefix" id="prefix" value="<?= $nama ?>">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn bg-blue text-white" name="btn" id="btn" value="delete">Hapus</button>
                        <a href='dashboard.php' class="btn bg-blue text-white">Batal</a>
                    </div>
                </form>
            <?php }  ?>
        </div>
    </main>
    <footer>
        <div class="container-fluid">
            <p class="text-center text-muted text-white">Copyright &copy; <?= date('Y') ?> Muhammad Novel. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        $.getJSON('api?type=indonesia', function(data) {

            function formatRupiah(angka) {
                var number_string = angka.toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            }

            var mounth = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ]

            var yy, mm, dd, h, m, s
            var d = new Date(data.data.lastUpdate)
            yy = d.getFullYear()
            mm = d.getMonth()
            dd = d.getDate()
            h = d.getHours()
            m = d.getMinutes()
            s = d.getSeconds()
            var date = dd + ' ' + mounth[mm] + ' ' + yy + ' ' + h + ':' + m + ':' + s + ' WIB'

            $('#sembuh').text(`Total: ${formatRupiah(data.data.sembuh)}`)
            $('#positif').text(`Total: ${formatRupiah(data.data.positif)}`)
            $('#meninggal').text(`Total: ${formatRupiah(data.data.meninggal)}`)
            $('#dirawat').text(`Total: ${formatRupiah(data.data.dirawat)}`)
            $('#lastUpdate').text(`Last Update: ` + date)
        })

        function collapse(name) {
            $('#' + name).toggleClass('d-none')
            window.location.href = '#' + name
        }

        let mybutton = document.getElementById("btn-back-to-top");
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
</body>

</html>