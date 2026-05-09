<?php

function e($value)
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect_with_message($message)
{
  header("Location: index.php?msg=" . urlencode($message));
  exit;
}

function get_product_by_id($conn, $id)
{
  $stmt = mysqli_prepare($conn, "SELECT idpro, nombre, precio, existencia FROM productos WHERE idpro = ? LIMIT 1");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  return mysqli_fetch_assoc($result);
}
