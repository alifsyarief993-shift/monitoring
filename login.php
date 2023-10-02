<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IoT Theme</title>
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
            background-image: linear-gradient(120deg, #1f2739, #243142); /* Latar belakang dengan gradient warna */
            background-size: cover;
            background-repeat: no-repeat;
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
    <div class="container">
        <h2>Login</h2>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            header('Location: index.php');
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

            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($koneksi, $sql);

            if ($result && mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit();
            } else {
                $error = "Username atau password salah.";
            }
        }
        ?>

        <?php if (isset($error)) : ?>
            <div class="alert" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <!-- Formulir login -->
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <!-- Tombol untuk mengarahkan ke halaman registrasi -->
        <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Registrasi</a></p>
    </div>
</body>
</html>
