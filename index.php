<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f4f4;
        }

        h2{
            text-align: center;
        }

        .container{
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        input{
            width: 98%;
            padding: 8px;
            margin: 5px 0 10px;
        }

        button{
            padding: 10px 20px;
            background-color: royalblue;
            color: white;
            border: none;
            cursor: pointer;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td{
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th{
            background-color: royalblue;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">

<h2>Sistem Penilaian Mahasiswa</h2>

<form method="post">

    <label>Nama</label>
    <input type="text" name="nama" required>

    <label>NIM</label>
    <input type="text" name="nim" required>

    <label>Nilai Tugas</label>
    <input type="number" name="tugas" required>

    <label>Nilai UTS</label>
    <input type="number" name="uts" required>

    <label>Nilai UAS</label>
    <input type="number" name="uas" required>

    <button type="submit" name="proses">Submit</button>

</form>

<?php

function hitungNilaiAkhir($tugas, $uts, $uas){
    return ($tugas*0.3)+($uts*0.3)+($uas*0.4);
}

function grade($nilai){
    if($nilai >= 85){
        return "A";
    }elseif($nilai >= 75){
        return "B";
    }elseif($nilai >= 65){
        return "C";
    }elseif($nilai >= 50){
        return "D";
    }else{
        return "E";
    }
}

if(isset($_POST['proses'])){

    $mahasiswa = [
        [
            "nama" => $_POST['nama'],
            "nim" => $_POST['nim'],
            "tugas" => $_POST['tugas'],
            "uts" => $_POST['uts'],
            "uas" => $_POST['uas']
        ]
    ];

    $totalNilai = 0;
    $nilaiTertinggi = 0;

    echo "<table>";
    echo "<tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nilai Akhir</th>
            <th>Grade</th>
            <th>Status</th>
          </tr>";

    foreach($mahasiswa as $m){

        $nilaiAkhir = hitungNilaiAkhir($m['tugas'],$m['uts'],$m['uas']);

        $grade = grade($nilaiAkhir);

        if($nilaiAkhir >= 60){
            $status = "Lulus";
        }else{
            $status = "Tidak Lulus";
        }

        echo "<tr>";
        echo "<td>".$m['nama']."</td>";
        echo "<td>".$m['nim']."</td>";
        echo "<td>".number_format($nilaiAkhir,2)."</td>";
        echo "<td>".$grade."</td>";
        echo "<td>".$status."</td>";
        echo "</tr>";

        $totalNilai += $nilaiAkhir;

        if($nilaiAkhir > $nilaiTertinggi){
            $nilaiTertinggi = $nilaiAkhir;
        }
    }

    $rataRata = $totalNilai / count($mahasiswa);

    echo "</table>";

    echo "<h3>Rata-rata Kelas : ".number_format($rataRata,2)."</h3>";
    echo "<h3>Nilai Tertinggi : ".number_format($nilaiTertinggi,2)."</h3>";
}

?>

</div>

</body>
</html>
