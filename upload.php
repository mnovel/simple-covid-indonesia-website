<?php
session_start();
include_once "connection.php";

$btn = $_POST['btn'] ?? null;
$urut = $_POST['urut'] ?? null;
$getNama = $_POST['prefix'] ?? null;

if ($btn == 'upload') {
    $id = $_SESSION['userid'];
    $nama = $_POST['nama'];
    $gambar1 = base64_encode(file_get_contents($_FILES['sertif']['tmp_name'][0]));
    $gambar2 = base64_encode(file_get_contents(empty($_FILES['sertif']['tmp_name'][1]) ? 'assets/img/certificate.jpg' : $_FILES['sertif']['tmp_name'][1]));
    $tgl1 = $_POST['tgl'];
    $tgl2 = date('Y-m-d', strtotime('+28 day', strtotime($_POST['tgl'])));
    $tempat = $_POST['tempat'];

    $input = mysqli_query($connection, "INSERT INTO sertif (id,nama,gambar1,gambar2,tanggal1,tanggal2,tempat) VALUE ('$id','$nama','$gambar1','$gambar2','$tgl1','$tgl2','$tempat')");
    if ($input) {
        header('location:dashboard.php');
    } else {
        echo mysqli_error($connection);
    }
}

if ($urut == 1 && $btn == 'edit') {
    $id = $_SESSION['userid'];
    $nama = $_POST['nama'];
    $tgl1 = $_POST['tgl'];
    $tgl2 = date('Y-m-d', strtotime('+28 day', strtotime($_POST['tgl'])));
    $tempat = $_POST['tempat'];
    if ($_FILES['sertif']['error'] > 0) {
        $input = mysqli_query($connection, "UPDATE sertif SET nama='$nama', tanggal1='$tgl1', tanggal2='$tgl2', tempat='$tempat' WHERE nama = '$getNama'");
        if ($input) {
            header('location:dashboard.php');
            exit;
        } else {
            echo mysqli_error($connection);
            exit;
        }
    }
    $gambar1 = base64_encode(file_get_contents($_FILES['sertif']['tmp_name']));
    $input = mysqli_query($connection, "UPDATE sertif SET nama='$nama', gambar1='$gambar1', tanggal1='$tgl1', tanggal2='$tgl2', tempat='$tempat' WHERE nama = '$getNama'");
    if ($input) {
        header('location:dashboard.php');
        exit;
    } else {
        echo mysqli_error($connection);
        exit;
    }
}

if ($urut == 2 && $btn == 'edit') {
    $id = $_SESSION['userid'];
    $nama = $_POST['nama'];
    $tgl2 = $_POST['tgl'];
    $tempat = $_POST['tempat'];
    if ($_FILES['sertif']['error'] > 0) {
        $input = mysqli_query($connection, "UPDATE sertif SET nama='$nama', tanggal2='$tgl2', tempat='$tempat' WHERE nama = '$getNama'");
        if ($input) {
            header('location:dashboard.php');
            exit;
        } else {
            echo mysqli_error($connection);
            exit;
        }
    }

    $gambar2 = base64_encode(file_get_contents($_FILES['sertif']['tmp_name']));
    $input = mysqli_query($connection, "UPDATE sertif SET nama='$nama', gambar2='$gambar2', tanggal2='$tgl2', tempat='$tempat' WHERE nama = '$getNama'");
    if ($input) {
        header('location:dashboard.php');
        exit;
    } else {
        echo mysqli_error($connection);
        exit;
    }
}

if ($btn == 'delete') {
    $cek = mysqli_query($connection, "DELETE FROM sertif WHERE nama='$getNama'");
    if ($cek) {
        header('location:dashboard.php');
        exit;
    } else {
        echo mysqli_error($connection);
        exit;
    }
}
