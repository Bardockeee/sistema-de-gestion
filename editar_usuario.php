<?php
include("conexion.php");
$con = conectar();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $id = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $contraseña = $_POST['contrasena'];

    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', rol='$rol', contrasena='$contraseña' WHERE id_usuario='$id'";

    $query = mysqli_query($con, $sql);

    if ($query) {
       
        header("Location: editar_usuario.php?id_usuario=$id&actualizado=exito");
        exit();
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($con);
    }
}


if (isset($_GET['id_usuario'])) {
    $id = $_GET['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id_usuario='$id'";
    $query = mysqli_query($con, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
    } else {
        echo "Registro no encontrado.";
        exit();
    }
} else {
    echo "ID no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>

<?php
 
    if (isset($_GET['actualizado']) && $_GET['actualizado'] === 'exito') {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var actualizacionExitosaModal = new bootstrap.Modal(document.getElementById('actualizacionExitosaModal'));
                actualizacionExitosaModal.show();
            });
        </script>";
    }
    ?>

    <div class="container-fluid">
        <form method="POST">
            <h2 class="text-white text-center">Actualizar Usuario</h2>
            
            <input type="hidden" name="id_usuario" value="<?= $row['id_usuario']; ?>">

            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $row['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $row['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="Administrador" <?= $row['rol'] === 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
                    <option value="Recepcionista" <?= $row['rol'] === 'Recepcionista' ? 'selected' : ''; ?>>Recepcionista</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?= $row['contrasena']; ?>" required>
                    <button class="btn btn-danger" type="button" id="togglePassword">
                        <i class="bi bi-eye"></i> 
                    </button>
                </div>
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-danger w-100">Actualizar</button>
            </div>
        </form>
    </div>
    <!-- Modal de éxito  -->
    <div class="modal fade" id="actualizacionExitosaModal" tabindex="-1" aria-labelledby="actualizacionExitosaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
        <div class="modal-header border-secondary">
            <h5 class="modal-title" id="actualizacionExitosaLabel">¡Actualización Exitosa!</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Los datos se han actualizado correctamente.
        </div>
        <div class="modal-footer border-secondary">
            <button type="button" class="btn btn-light" onclick="redirigirUsuarios()">Aceptar</button>
        </div>
        </div>
    </div>
    </div>
    
    <script>
    function redirigirUsuarios() {
        window.location.href = 'usuarios.php'; 
    }
    </script>

    <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('contrasena');
            const passwordButton = document.getElementById('togglePassword');
            const icon = passwordButton.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash'); 
            } else {
                passwordField.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>    

</body>
</html>