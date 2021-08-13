<?php

header('Content-Type: application/json');

$type = $_GET['type'] ?? null;


function json($status, $message, $data)
{
    $data = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];

    echo json_encode($data);
}

function curl($link)
{
    $data = file_get_contents($link);
    return  json_decode($data);
}

if ($type == null) {
    json('error', 'Data yang anda cari tidak ditemukan', null);
}

if ($type == 'indonesia') {
    json('success', 'Data ditemukan', curl('https://apicovid19indonesia-v2.vercel.app/api/indonesia'));
}

if ($type == 'harian') {
    $limit = $_GET['limit'] ?? 20;
    $array = curl('https://apicovid19indonesia-v2.vercel.app/api/indonesia/harian');
    $a = [];
    $b = [];
    $c = [];
    $d = [];
    foreach (array_slice(array_reverse($array), 0, $limit) as $result) {
        array_push($a, date("j M", strtotime($result->tanggal)));
        array_push($b, $result->positif);
        array_push($c, $result->sembuh);
        array_push($d, $result->meninggal);
    }
    $data = [
        'tanggal' => array_reverse($a),
        'positif' => array_reverse($b),
        'sembuh' => array_reverse($c),
        'meninggal' => array_reverse($d),
    ];
    json('success', 'Data ditemukan', $data);
}

if ($type == 'kasus') {
    $data = curl('https://apicovid19indonesia-v2.vercel.app/api/indonesia/provinsi/alt');
    json('success', 'Data ditemukan', $data);
}

if ($type == 'rs') {
    $data = curl('https://dekontaminasi.com/api/id/covid19/hospitals');
    json('success', 'Data ditemukan', $data);
}
