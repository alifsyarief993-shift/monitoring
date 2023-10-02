<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "monitoring_cabai";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Monitoring Suhu Dan Gas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>

body {
    background-color: #6495ed;
}


        



/* Teks Selamat Datang Ditengahkan */
.teks-selamat-datang {
    text-align: center;
}

/* Tampilan Tabel Cabai */
.card {
    margin-bottom: 20px;
}

.table {
    width: 100%;
}

.table th,
.table td {
    padding: 10px;
    border: 1px solid #ccc;
}

/* Tampilan Tabel Suhu */
.card {
    margin-bottom: 20px;
}

.table {
    width: 100%;
}

.table th,
.table td {
    padding: 10px;
    border: 1px solid #ccc;
}

/* Tampilan Tabel Gas */
.card {
    margin-bottom: 20px;
}

.table {
    width: 100%;
}

.table th,
.table td {
    padding: 10px;
    border: 1px solid #ccc;
}

/* Tombol untuk mengarahkan ke halaman input.php */
.btn {
    margin-top: 20px;
    color: black;
    background-color: #eee;
}
.logout-btn {
    margin-top:20px;
    color: black;
    background-color: #eee;
}




        
    </style>
</head>
<body>
   

    <!-- Teks Selamat Datang Ditengahkan -->
    <div class="container mt-4 teks-selamat-datang">
        <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
    </div>

    <!-- Tampilan Tabel Cabai -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Data Cabai
            </div>
            <div class="card-body">
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Cabai</th>
                            <th scope="col">Warna Cabai</th>
                            <th scope="col">Tanggal Planting</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlCabai = "SELECT * FROM cabai";
                        $resultCabai = mysqli_query($koneksi, $sqlCabai);
                        $urut = 1;
                        while ($rowCabai = mysqli_fetch_array($resultCabai)) {
                            $namaCabai = $rowCabai['nama_cabai'];
                            $warnaCabai = $rowCabai['warna_cabai'];
                            $tanggalPlanting = $rowCabai['tanggal_planting'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td><?php echo $namaCabai ?></td>
                                <td><?php echo $warnaCabai ?></td>
                                <td><?php echo $tanggalPlanting ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tampilan Tabel Suhu -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Data Suhu
            </div>
            <div class="card-body">
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Cabai</th>
                            <th scope="col">Nilai Suhu (Celcius)</th>
                            <th scope="col">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlSuhu = "SELECT * FROM suhu";
                        $resultSuhu = mysqli_query($koneksi, $sqlSuhu);
                        $urut = 1;
                        while ($rowSuhu = mysqli_fetch_array($resultSuhu)) {
                            $namaCabai = $rowSuhu['nama_cabai'];
                            $nilaiSuhu = $rowSuhu['suhu'];
                            $waktuSuhu = $rowSuhu['waktu'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td><?php echo $namaCabai ?></td>
                                <td><?php echo $nilaiSuhu ?></td>
                                <td><?php echo $waktuSuhu ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tampilan Tabel Gas -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Data Gas (CO2)
            </div>
            <div class="card-body">
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Cabai</th>
                            <th scope="col">Konsentrasi Gas (CO2)</th>
                            <th scope="col">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlGas = "SELECT * FROM gas";
                        $resultGas = mysqli_query($koneksi, $sqlGas);
                        $urut = 1;
                        while ($rowGas = mysqli_fetch_array($resultGas)) {
                            $namaCabaiGas = $rowGas['nama_cabai'];
                            $konsentrasiGas = $rowGas['konsentrasi_gas'];
                            $waktuGas = $rowGas['waktu'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td><?php echo $namaCabaiGas ?></td>
                                <td><?php echo $konsentrasiGas ?></td>
                                <td><?php echo $waktuGas ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Tombol untuk mengarahkan ke halaman input.php -->
<div class="container mt-4">
    <a href="input.php" class="btn btn-primary">Input Data Cabai, Suhu, dan Gas</a>
</div>
<div class="container mt-4">
        <!-- Tombol Logout -->
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>

</body>
</html>
