<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "monitoring_cabai";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

// Inisialisasi variabel untuk masing-masing form
$namaCabai = "";
$warnaCabai = "";
$tanggalPlanting = "";
$errorCabai = "";
$suksesCabai = "";

$namaCabaiSuhu = "";
$nilaiSuhu = "";
$waktuSuhu = "";
$errorSuhu = "";
$suksesSuhu = "";

$namaCabaiGas = "";
$konsentrasiGas = "";
$waktuGas = "";
$errorGas = "";
$suksesGas = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form Cabai
    if (isset($_POST['simpanCabai'])) {
        $namaCabai = $_POST['namaCabai'];
        $warnaCabai = $_POST['warnaCabai'];
        $tanggalPlanting = $_POST['tanggalPlanting'];

        if ($namaCabai && $warnaCabai && $tanggalPlanting) {
            $sqlCabai = "INSERT INTO cabai (nama_cabai, warna_cabai, tanggal_planting) VALUES ('$namaCabai', '$warnaCabai', '$tanggalPlanting')";
            $resultCabai = mysqli_query($koneksi, $sqlCabai);

            if ($resultCabai) {
                $suksesCabai = "Data Cabai berhasil disimpan";
                $namaCabai = "";
                $warnaCabai = "";
                $tanggalPlanting = "";
            } else {
                $errorCabai = "Gagal menyimpan data Cabai";
            }
        } else {
            $errorCabai = "Silakan masukkan semua data Cabai";
        }
    }

    // Form Suhu
    if (isset($_POST['simpanSuhu'])) {
        $namaCabaiSuhu = $_POST['namaCabaiSuhu'];
        $nilaiSuhu = $_POST['nilaiSuhu'];
        $waktuSuhu = $_POST['waktuSuhu'];

        if ($namaCabaiSuhu && $nilaiSuhu && $waktuSuhu) {
            $sqlSuhu = "INSERT INTO suhu (nama_cabai, suhu, waktu) VALUES ('$namaCabaiSuhu', '$nilaiSuhu', '$waktuSuhu')";
            $resultSuhu = mysqli_query($koneksi, $sqlSuhu);

            if ($resultSuhu) {
                $suksesSuhu = "Data Suhu berhasil disimpan";
                $namaCabaiSuhu = "";
                $nilaiSuhu = "";
                $waktuSuhu = "";
            } else {
                $errorSuhu = "Gagal menyimpan data Suhu";
            }
        } else {
            $errorSuhu = "Silakan masukkan semua data Suhu";
        }
    }

    // Form Gas (CO2)
    if (isset($_POST['simpanGas'])) {
        $namaCabaiGas = $_POST['namaCabaiGas'];
        $konsentrasiGas = $_POST['konsentrasiGas'];
        $waktuGas = $_POST['waktuGas'];

        if ($namaCabaiGas && $konsentrasiGas && $waktuGas) {
            $sqlGas = "INSERT INTO gas (nama_cabai, konsentrasi_gas, waktu) VALUES ('$namaCabaiGas', '$konsentrasiGas', '$waktuGas')";
            $resultGas = mysqli_query($koneksi, $sqlGas);

            if ($resultGas) {
                $suksesGas = "Data Gas berhasil disimpan";
                $namaCabaiGas = "";
                $konsentrasiGas = "";
                $waktuGas = "";
            } else {
                $errorGas = "Gagal menyimpan data Gas";
            }
        } else {
            $errorGas = "Silakan masukkan semua data Gas";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Cabai, Suhu, dan Gas</title>
    <style>

        body {
            background-color: #EEEEEE;
        }   
        

        /* Gaya umum untuk kontainer form */
        .form-container {
            width: 70%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #FFFFCC;
        }
        .container h2 {
            font-size: 24px;
            font-weight: bold;
        }

        /* Gaya untuk pesan sukses */
        .success-message {
            color: green;
            margin-top: 10px;
        }

        /* Gaya untuk pesan error */
        .error-message {
            color: red;
            margin-top: 10px;
        }

        /* Gaya untuk tombol */
        button[type="submit"] {
            background-color: #99CC00;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Gaya untuk tautan kembali */
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        /* Gaya untuk elemen input */
        input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Gaya untuk label */
        label {
            font-size: 14px;
            font-weight: bold;
        }

        /* Gaya untuk ikon */
        i {
            font-size: 20px;
        }

        /* Gaya untuk layout dua kolom */
        .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .left-column {
            width: 50%;
        }

        .right-column {
            width: 50%;
        }
        .btn {
        font-size: 18px;
        font-weight: bold;
        background-color: #FFFFCC;
        color: black;
        margin-left: 205px;
        margin-top: -1px;
        }

        
    </style>
</head>
<body>

<div class="form-container" style="justify-content: center; align-items: center;">
    <h3>Form Input Data Cabai, Suhu Dan Gas</h3>
</div>



    
</div>

    <!-- Form Input Data Cabai -->
    <div class="form-container">
        <h3>Form Input Data Cabai</h3>
        <?php if ($errorCabai) : ?>
            <div class="error-message"><?php echo $errorCabai; ?></div>
        <?php endif; ?>
        <?php if ($suksesCabai) : ?>
            <div class="success-message"><?php echo $suksesCabai; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="namaCabai">Nama Cabai:</label>
            <input type="text" id="namaCabai" name="namaCabai" value="<?php echo $namaCabai; ?>" required><br><br>

            <label for="warnaCabai">Warna Cabai:</label>
            <input type="text" id="warnaCabai" name="warnaCabai" value="<?php echo $warnaCabai; ?>" required><br><br>

            <label for="tanggalPlanting">Tanggal Planting:</label>
            <input type="date" id="tanggalPlanting" name="tanggalPlanting" value="<?php echo $tanggalPlanting; ?>" required><br><br>

            <button type="submit" name="simpanCabai">Simpan Data Cabai</button>
        </form>
    </div>

    <!-- Form Input Data Suhu -->
    <div class="form-container">
        <h3>Form Input Data Suhu</h3>
        <?php if ($errorSuhu) : ?>
            <div class="error-message"><?php echo $errorSuhu; ?></div>
        <?php endif; ?>
        <?php if ($suksesSuhu) : ?>
            <div class="success-message"><?php echo $suksesSuhu; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="namaCabaiSuhu">Nama Cabai:</label>
            <input type="text" id="namaCabaiSuhu" name="namaCabaiSuhu" value="<?php echo $namaCabaiSuhu; ?>" required><br><br>

            <label for="nilaiSuhu">Nilai Suhu:</label>
            <input type="text" id="nilaiSuhu" name="nilaiSuhu" value="<?php echo $nilaiSuhu; ?>" required><br><br>

            <label for="waktuSuhu">Waktu:</label>
            <input type="datetime-local" id="waktuSuhu" name="waktuSuhu" value="<?php echo $waktuSuhu; ?>" required><br><br>

            <button type="submit" name="simpanSuhu">Simpan Data Suhu</button>
        </form>
    </div>

    <!-- Form Input Data Gas (CO2) -->
    <div class="form-container">
        <h3>Form Input Data Gas (CO2)</h3>
        <?php if ($errorGas) : ?>
            <div class="error-message"><?php echo $errorGas; ?></div>
        <?php endif; ?>
        <?php if ($suksesGas) : ?>
            <div class="success-message"><?php echo $suksesGas; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="namaCabaiGas">Nama Cabai:</label>
            <input type="text" id="namaCabaiGas" name="namaCabaiGas" value="<?php echo $namaCabaiGas; ?>" required><br><br>

            <label for="konsentrasiGas">Konsentrasi Gas (CO2):</label>
            <input type="text" id="konsentrasiGas" name="konsentrasiGas" value="<?php echo $konsentrasiGas; ?>" required><br><br>

            <label for="waktuGas">Waktu:</label>
            <input type="datetime-local" id="waktuGas" name="waktuGas" value="<?php echo $waktuGas; ?>" required><br><br>

            <button type="submit" name="simpanGas">Simpan Data Gas (CO2)</button>
        </form>
    </div>
    
    <!-- Button Kembali ke Indeks -->
    <div class="container mt-4">
    <a href="index.php" class="btn btn-primary">Halaman Utama</a>
</div>
</body>
</html>
