<?php
session_start();
include_once "connection.php";

if (isset($_POST['nama'])) {
    $id = $_SESSION['userid'];
    $nama = $_POST['nama'];
    $urut = $_POST['urut'];
    $tgl = $_POST['tgl'];
    $tempat = $_POST['tempat'];
    $sertif = base64_encode(file_get_contents($_FILES['sertif']['tmp_name']));

    $input = mysqli_query($connection, "INSERT INTO sertif (id,nama,urut,tanggal,tempat,gambar) VALUE ('$id','$nama','$urut','$tgl','$tempat','$sertif')");
    header('location:dashboard.php');
}
