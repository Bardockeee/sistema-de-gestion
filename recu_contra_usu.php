<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Recuperar Contraseña</h2>
            <form action="validar_correo.php" method="POST" class="mt-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Ingresa tu correo</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
    </div>        


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>