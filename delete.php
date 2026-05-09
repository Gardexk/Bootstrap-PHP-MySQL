<?php
include "db_conn.php";
include "helpers.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
  redirect_with_message("Producto no encontrado");
}

$sql = "DELETE FROM `productos` WHERE idpro = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
$result = mysqli_stmt_execute($stmt);

if ($result) {
  redirect_with_message("Producto eliminado correctamente");
} else {
  echo "Failed: " . mysqli_error($conn);
}
