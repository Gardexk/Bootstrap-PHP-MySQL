<?php
include "db_conn.php";
include "helpers.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
  redirect_with_message("Producto no encontrado");
}

if (isset($_POST["submit"])) {
  $nombre = trim($_POST['nombre']);
  $precio = (float) $_POST['precio'];
  $existencia = (int) $_POST['existencia'];

  if ($nombre === '' || $precio < 0 || $existencia < 0) {
    $error = "Verifica que los datos sean validos.";
  } else {
    $sql = "UPDATE `productos` SET `nombre` = ?, `precio` = ?, `existencia` = ? WHERE idpro = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sdii", $nombre, $precio, $existencia, $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
      redirect_with_message("Producto actualizado correctamente");
    } else {
      echo "Failed: " . mysqli_error($conn);
    }
  }
}

$row = get_product_by_id($conn, $id);

if (!$row) {
  redirect_with_message("Producto no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>CityUNACH</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    CityUNACH
  </nav>

  <main class="container">
    <div class="text-center mb-4">
      <h3>Editar información del producto</h3>
      <p class="text-muted">Actualice los datos necesarios y guarde los cambios.</p>
    </div>

    <?php if (isset($error)) { ?>
      <div class="alert alert-danger" role="alert"><?php echo e($error); ?></div>
    <?php } ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo e($row['nombre']) ?>" required>
          </div>

          <div class="col">
            <label class="form-label">Precio:</label>
            <input type="number" class="form-control" name="precio" value="<?php echo e($row['precio']) ?>" min="0" step="0.01" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Existencia:</label>
          <input type="number" class="form-control" name="existencia" value="<?php echo e($row['existencia']) ?>" min="0" step="1" required>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Actualizar</button>
          <a href="index.php" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
    </div>
  </main>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
