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
                        <a class="nav-link active" aria-current="page" href="dashboard.php"><i class="fas fa-home-lg-alt"></i> Home</a>
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
        <h2 class="text-center mb-5 text-muted">Sertifikat Vaksin</h2>
        <div class="container col-md-8 col-10 mb-5">
            <?php
            $id = $_SESSION['userid'];
            $data = mysqli_query($connection, "SELECT * FROM sertif WHERE id ='$id' GROUP BY nama");
            foreach ($data as $res) :
            ?>
                <div class="shadow p-2 bg-white mb-3 name-collapse ayahBtn" role="button" onclick="collapse('<?= preg_replace('/ /i', '', $res['nama']) ?>');">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 w-100 bd-highlight f-collapse text-muted text-uppercase">
                            <?= $res['nama'] ?>
                        </div>
                        <div class="p-2 flex-shrink-1 bd-highlight">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4 mb-5 mt-3 d-none" id="<?= preg_replace('/ /i', '', $res['nama']) ?>">
                    <?php
                    $nama = $res['nama'];
                    $data = mysqli_query($connection, "SELECT * FROM sertif WHERE nama ='$nama'");
                    $fetch = mysqli_fetch_all($data);
                    ?>
                    <div class="col">
                        <div class="card name-collapse">
                            <img src="data:image/jpege;base64,<?= $fetch[0][2] ?>" class="card-img-top" alt="<?= preg_replace('/ /i', '', $res['nama']) ?>">
                            <div class="card-body">
                                <div class="d-flex bd-highlight">
                                    <div class="flex-grow-1 bd-highlight">
                                        <h5 class="text-muted mb-4">Vaksin Pertama</h5>
                                    </div>
                                    <div class="p-2 bd-highlight"><i class="fal fa-trash-alt text-danger" role="button" onclick="redirect('delete','<?= $fetch[0][1] ?>',1)"></i></div>
                                    <div class="p-2 bd-highlight"><i class="fas fa-pencil text-warning" role="button" onclick="redirect('edit','<?= $fetch[0][1] ?>',1)"></i></div>
                                </div>
                                <h6><?= date('d F Y', strtotime($fetch[0][4])) ?></h6>
                                <p class="card-text text-uppercase"><?= $fetch[0][6] ?>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card name-collapse">
                            <img src="data:image/jpege;base64,<?= $fetch[0][3] ?>" class="card-img-top" alt="ayah">
                            <div class="card-body">
                                <div class="d-flex bd-highlight">
                                    <div class="flex-grow-1 bd-highlight">
                                        <h5 class="text-muted mb-4">Vaksin Kedua</h5>
                                    </div>
                                    <div class="p-2 bd-highlight"><i class="fal fa-trash-alt text-danger" role="button" onclick="redirect('delete','<?= $fetch[0][1] ?>',2)"></i></div>
                                    <div class="p-2 bd-highlight"><i class="fas fa-pencil text-warning" role="button" onclick="redirect('edit','<?= $fetch[0][1] ?>',2)"></i></div>
                                    <div class="p-2 bd-highlight  <?= preg_match('/\/9j\/4AAQSkZJRgAB/i', $fetch[0][3]) ? '' : 'd-none' ?>"><i class="fas fa-info text-info" role="button" data-bs-toggle="tooltip" data-bs-html="true" title="<h5>Informasi Sertifikat</h5><P>E-Sertifikat vaksin kedua Anda belum terbit, segera lakukan vaksinasi kedua Anda sesuai lokasi & jadwal yang tercantum pada kartu vaksin Anda.</P>"></i></div>
                                </div>
                                <h6><?= date('d F Y', strtotime($fetch[0][5])) ?></h6>
                                <p class=" card-text text-uppercase"><?= $fetch[0][6] ?>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </main>
    <div class="modal fade" id="tambahSertif" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-blue text-white">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Sertifikat</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body bg-white text-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Vaksin Pertama</label>
                            <input class="form-control" type="date" name="tgl" id="tgl" placeholder="1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tempat Vaksin</label>
                            <textarea class="form-control" name="tempat" id="tempat" rows="3" placeholder="KKP KELAS II PROBOLINGGO WILAYAH KERJA PASURUAN" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sertivikat Vaksin</label>
                            <input class="form-control" type="file" name="sertif[]" id="sertif[]" multiple required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn bg-primary text-white" name="btn" id="btn" value="upload">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

        function redirect(type, nama, id) {
            window.location.href = `crud.php?type=${type}&id=${id}&nama=${nama}`
        }
    </script>
</body>

</html>