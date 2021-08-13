<?php
$array = [
    'ayah-1.jpg',
    'ayah-2.jpg',
    'mama-1.jpg',
    'aku-1.jpg',
    'adek-1.jpg',
];

$array2 = [];
foreach ($array as $result) {
    $data = file_get_contents('assets/img/' . $result);
    $image = base64_encode($data);
    array_push($array2, "data:image/jpeg;base64,$image");
}

header('Content-Type: application/json');
echo json_encode($array2);
