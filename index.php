<?php
include "db_conn.php";
include "helpers.php";
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
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      ' . e($msg) . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>';
    }
    ?>

    <a href="add-new.php" class="btn btn-dark mb-3">Añadir nuevo producto</a>

    <div class="table-responsive">
      <table class="table table-hover align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Existencia</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT idpro, nombre, precio, existencia FROM `productos` ORDER BY idpro DESC";
          $result = mysqli_query($conn, $sql);

          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?php echo e($row["idpro"]) ?></td>
              <td><?php echo e($row["nombre"]) ?></td>
              <td>$<?php echo e(number_format((float) $row["precio"], 2)) ?></td>
              <td><?php echo e($row["existencia"]) ?></td>
              <td>
                <a href="edit.php?id=<?php echo e($row["idpro"]) ?>" class="link-dark" aria-label="Editar producto"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="delete.php?id=<?php echo e($row["idpro"]) ?>" class="link-dark" aria-label="Eliminar producto" onclick="return confirm('¿Eliminar este producto?');"><i class="fa-solid fa-trash fs-5"></i></a>
              </td>
            </tr>
          <?php
            }
          } else {
          ?>
            <tr>
              <td colspan="5" class="text-muted py-4">No hay productos registrados.</td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
