<?php

$kodeMataKuliah = [
    'pwl' => 'Pemrogramman Web Lanjut', 
    'ai' => 'Artificial Intelligence',
    'sbd' => 'Sistem Basis Data'
];


// nilai mahasiswa
$nilaiMahasiswa = [
    ['nama' => 'Toni', 'nilai' => ['pwl' => 80, 'ai' => 60, 'sbd' => 75]],
    ['nama' => 'Dewi', 'nilai' => ['pwl' => 90, 'ai' => 70, 'sbd' => 75]],
    ['nama' => 'Nina', 'nilai' => ['pwl' => 75, 'ai' => 95, 'sbd' => 80]],
    ['nama' => 'Reza', 'nilai' => ['pwl' => 60, 'ai' => 50, 'sbd' => 70]]
];


// rata-rata per mata kuliah
function averageMataKuliah() {
    global $kodeMataKuliah;

    global $nilaiMahasiswa;

    echo "<i><h2>Nilai rata-rata per mata kuliah</h2></i>";

    foreach ($kodeMataKuliah as $kode => $mataKuliah) {
        $sumNilai = 0;

        foreach ($nilaiMahasiswa as $nilai) {
            $sumNilai += $nilai['nilai'][$kode];
        }

        $avgNilaiMatkul = $sumNilai / count($nilaiMahasiswa);
        $avgNilaiMatkul = number_format($avgNilaiMatkul, 2);

        echo " - {$mataKuliah} : {$avgNilaiMatkul}<br>";

    }
}


// rata-rata per mahasiswa
function averageNilaiMahasiswa() {
    echo "<br><h2><i>Nilai rata-rata per mahasiswa</h2></i>";
    global $nilaiMahasiswa;

    foreach ($nilaiMahasiswa as $nilai) {
        $avgNilaiMhs = array_sum($nilai['nilai']) / count($nilai['nilai']);

        $avgNilaiMhs = number_format($avgNilaiMhs, 2);

        echo " - {$nilai['nama']} : {$avgNilaiMhs}<br>";
    }
}


// menambahkan data ke dalam array
function tambahData($nama, $nilaiPwl, $nilaiAi, $nilaiSbd) {
    global $nilaiMahasiswa;

    array_push(
        $nilaiMahasiswa, 
        [
            'nama' => $nama,
            'nilai' => ['ai' => $nilaiAi, 'pwl' => $nilaiPwl, 'sbd' => $nilaiSbd]
        ]
    );
}


// sorting dan menampilkan secara ascending
function sortArrayAsc() {
    echo "<br><h2><i>Nilai Mahasiswa Ascending</i></h2>";
    global $nilaiMahasiswa;

    global $kodeMataKuliah;

    foreach ($kodeMataKuliah as $kode => $mataKuliah) {
        $mhs = [];

        foreach ($nilaiMahasiswa as $nilaiMhs) {
            $mhs[] = [
                'nama' => $nilaiMhs['nama'],
                'nilai' => $nilaiMhs['nilai'][$kode]
            ];
        }
        

        array_multisort(array_column($mhs, 'nilai'), SORT_ASC, $mhs);

        echo "<br><b><i>{$mataKuliah} : </i></b><br>";

        foreach ($mhs as $dataMhs) {
            printf(' - %s: %s <br>', $dataMhs['nama'], $dataMhs['nilai']);
        }
    }
}


// menghapus data terakhir pada array
function removeLastData(){
    array_pop($GLOBALS['nilaiMahasiswa']);
}

averageMataKuliah();
 averageNilaiMahasiswa();

tambahData('Ari', 75, 60, 80);
sortArrayAsc();
averageMataKuliah();
 
removeLastData();
removeLastData();
sortArrayAsc();
averageMataKuliah();

?>