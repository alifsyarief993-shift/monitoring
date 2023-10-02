<?php
session_start();
session_destroy();
header('Location: login.php'); // Mengarahkan ke halaman login setelah logout
exit();
?>