<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
include_once "koneksi.php";

// Deklarasi variable keyword buah.
$toko = $_GET["query"];

// Query ke database.
$query  = $konek->query("SELECT * FROM tbl_toko WHERE nama_toko LIKE '%$toko%' ORDER BY nama_toko ASC");

// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['nama_toko'],
            'nama'  => $data['nama_toko'],
            'kode'  => $data['kode_toko']
        ];
    }

    // Encode ke JSON.
    echo json_encode($output);

// Jika tidak ada yang cocok.
} else {
    $output['suggestions'][] = [
        'value' => '',
        'nama'  => '',
        'kode'  => ''
    ];

    // Encode ke JSON.
    echo json_encode($output);
}
