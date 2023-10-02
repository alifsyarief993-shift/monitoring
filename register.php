<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - IoT Theme</title>
    <style>
        body {
            background-color: #333; /* Dark background color */
            font-family: Arial, sans-serif;
            color: #FFFFFF; /* Text color */
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), #333; /* Gradient background with semi-transparent overlay */
        }

        /* Ornamen bintang-bintang */
        .stars {
            background: transparent;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .stars:before, .stars:after {
            content: "";
            position: absolute;
            top: 100px;
            left: 50%;
            width: 1px;
            height: 100px;
            background: #FFF;
        }

        .stars:before {
            left: 25%;
        }

        .stars:after {
            left: 75%;
        }

        .container {
            width: 80%; /* Lebar container */
            max-width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5); /* Increased box shadow for an elegant effect */
        }

        h2 {
            text-align: center;
            color: #4CAF50; /* Green heading color */
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            color: #FFFFFF;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2); /* Semi-transparent white input fields */
            color: #333; /* Darker text color for better readability */
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            background-color: rgba(255, 255, 255, 0.3); /* Slightly lighter background on focus */
        }

        button {
            background-color: #4CAF50; /* Green button color */
            color: #FFFFFF;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049; /* Slightly lighter green on hover */
        }

        .alert {
            background-color: #D32F2F; /* Red alert background color */
            color: #FFFFFF;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            color: #4CAF50; /* Green link color */
            text-decoration: none;
            display: block;
            text-align: center;
            font-weight: bold; /* Make the link more prominent */
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Ornamen bintang-bintang -->
    <div class="stars"></div>

    <div class="container">
        <h2>Registrasi</h2>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            header('Location: login.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "monitoring_cabai";

            $koneksi = mysqli_connect($host, $user, $pass, $db);
            if (!$koneksi) {
                die("Tidak bisa terkoneksi ke database");
            }

            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($koneksi, $sql);

            if ($result) {
                $_SESSION['username'] = $username;
                header('Location: login.php'); // Arahkan ke halaman login setelah registrasi
                exit();

            } else {
                $error = "Gagal mendaftar. Username mungkin sudah ada.";
            }
        }
        ?>

        <?php if (isset($error)) : ?>
            <div class="alert" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <!-- Formulir registrasi -->
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Registrasi</button>
        </form>

        <!-- Tombol untuk mengarahkan kembali ke halaman login -->
        <a href="login.php">Login</a>
    </div>
</body>
</html>
