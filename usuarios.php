<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>
  <div class="d-flex" style="height: 100vh;">
    <!-- Barra lateral -->
    <nav class="bg-dark text-white p-3" style="width: 250px;">
      <h4 class="text-center mb-4">Sistema de gestion</h4>
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a href="dashboard.html" class="nav-link text-white"><i class="bi bi-house"></i> Inicio</a>
        </li>
        <li class="nav-item mb-2">
          <a href="reservas.html" class="nav-link text-white"><i class="bi bi-calendar-check"></i> Reservas</a>
        </li>
        <li class="nav-item mb-2">
          <a href="checkin.html" class="nav-link text-white "><i class="bi bi-arrow-right-circle"></i> Check In</a>
        </li>
        <li class="nav-item mb-2">
          <a href="checkout.html" class="nav-link text-white"><i class="bi bi-arrow-left-circle"></i> Check Out</a>
        </li>
        <li class="nav-item mb-2">
          <a href="servicio.html" class="nav-link text-white"><i class="bi bi-door-open"></i> Servicio</a>
        </li>
        <li class="nav-item mb-2">
          <a href="clientes.html" class="nav-link text-white "><i class="bi bi-people"></i> Clientes</a>
        </li>
        <li class="nav-item mb-2">
            <a href="usuarios.php" class="nav-link text-white active"><i class="bi bi-people"></i> Usuarios</a>
        </li>
      </ul>
    </nav>

    <!-- Contenido principal -->
    <div class="flex-grow-1 bg-light">
        <!-- Encabezado -->
        <header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Gestión de usuarios</h5>
          <span>Administrador <i class="bi bi-power"></i></span>
        </header>
  
        <!-- Contenido -->
        <div class="p-4">

        
          <!-- Barra de búsqueda -->
          <div class="container-fluid d-flex justify-content-end align-items-center mb-3">
            <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal">
              <i class="bi bi-person-plus-fill"></i>
            </a>
            <form method="GET" class="d-flex" role="search" style="max-width: 400px;">
              <input class="form-control me-2" name="buscar" type="search" placeholder="Buscar usuario..." aria-label="Search">
              <button class="btn btn-primary" type="submit">Buscar</button>
            </form>
          </div>
  
          <!-- Tabla de clientes -->
          <div class="card shadow">
            <div class="card-body">
              <h5 class="card-title">Lista de usuarios</h5>
              <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    include 'mostrar.php'; 
                    if (mysqli_num_rows($query) > 0):
                        while ($row = mysqli_fetch_array($query)): ?>
                            <tr>
                                <td><?= $row['id_usuario']; ?></td>
                                <td><?= $row['nombre']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['rol']; ?></td>
                                <td>********</td> 
                                <td>
                                    <a href="editar_usuario.php?id_usuario=<?= $row['id_usuario']; ?>" class="btn btn-sm btn-primary">Editar</a>
                                    <a href="eliminar_usuario.php?id_usuario=<?= $row['id_usuario']; ?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                                        data-id="<?= $row['id_usuario']; ?>">
                                            Eliminar
                                    </a>
                                    <a href="recu_contra_usu.php?id_usuario=<?= $row['id_usuario']; ?>" class="btn btn-sm btn-warning">Recuperar Contraseña</a>
                                </td>
                            </tr>
                        <?php endwhile;
                    else: ?>
                        <tr>
                            <td colspan="10" class="text-center">No hay usuarios registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
   
    <div class="modal fade" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="agregarUsuarioLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="agregarUsuarioLabel">Agregar Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
       
          <div class="modal-body">
            <form method="POST" action="agregar_usuario.php">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>

              <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="rol" name="rol" required>
                  <option value="">Selecciona un rol</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Recepcionista">Recepcionista</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
                    <button class="btn btn-primary" type="button" id="togglePassword">
                        <i class="bi bi-eye"></i> <!-- Ícono del ojo -->
                    </button>
                </div>
            </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
      

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este registro?.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                
                <a href="eliminar_usuario.php?id_registro=<?= $row['id_usuario']; ?>" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
      </div>
    </div>


  <!-- Bootstrap JS y Iconos -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
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
    <script>
    
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        
        const button = event.relatedTarget;

        
        const id = button.getAttribute('data-id');

        
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        confirmDeleteButton.href = `eliminar_usuario.php?id_usuario=${id}`;
    });
    </script>
</body>
</html>
