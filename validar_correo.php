<?php
include "conexion.php";
$con = conectar();

$email = $_POST['email'];


if (!empty($email)) {
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $mensaje = "Correo válido. Redirigiendo para cambiar la contraseña...";
        $redireccion = "cambiar_contra.php?email=" . urlencode($email);
    } else {
        $mensaje = "Correo no encontrado. Por favor, verifica e intenta de nuevo.";
        $redireccion = "recu_contra_usu.php";
    }
} else {
    $mensaje = "Por favor, ingresa un correo.";
    $redireccion = "recu_contra_usu.php";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 
    <div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmacionModalLabel">Confirmación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $mensaje; ?>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo $redireccion; ?>" class="btn btn-primary">Aceptar</a>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        var confirmacionModal = new bootstrap.Modal(document.getElementById('confirmacionModal'));
        confirmacionModal.show();
    </script>
</body>
</html>