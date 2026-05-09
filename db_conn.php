<?php
$servername = getenv("DB_HOST") ?: "localhost";
$username = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASS") ?: "";
$dbname = getenv("DB_NAME") ?: "empresa";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Error de conexion: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
