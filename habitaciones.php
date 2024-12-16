<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css"> 
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
          <a href="habitaciones.php" class="nav-link text-white active"><i class="bi bi-door-open"></i>Habitaciones</a>
        </li>
        <li class="nav-item mb-2">
          <a href="servicio.php" class="nav-link text-white"><i class="bi bi-door-open"></i> Servicio</a>
        </li>
        <li class="nav-item mb-2">
          <a href="clientes.html" class="nav-link text-white "><i class="bi bi-people"></i> Clientes</a>
        </li>
        <li class="nav-item mb-2">
            <a href="usuarios.php" class="nav-link text-white "><i class="bi bi-people"></i> Usuarios</a>
        </li>
      </ul>
    </nav>

    <!-- Contenido principal -->
    <div class="container-fluid fondo-dashboard">
        <!-- Encabezado -->
        <header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Gestión de habitaciones</h5>
          <span>Administrador <i class="bi bi-power"></i></span>
        </header>
  
        <!-- Contenido -->
        <div class="p-4">

        
          <!-- Barra de búsqueda -->
          <div class="container-fluid d-flex justify-content-end align-items-center mb-3">
            <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#agregarHabitacionModal">Agregar habitacion
            <i class="bi bi-plus"></i>
            </a>
            <form method="GET" class="d-flex" role="search" style="max-width: 400px;">
              <input class="form-control me-2" name="buscar" type="search" placeholder="Buscar habitacion..." aria-label="Search">
              <button class="btn btn-primary" type="submit">Buscar</button>
            </form>
          </div>
  
          <!-- Tabla de clientes -->
          <div class="card shadow">
            <div class="card-body">
              <h5 class="card-title">Lista de habitaciones</h5>
              <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                  <tr>
                    <th>ID</th>
                    <th>Numero de la habitacion</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    include 'mostrar_habitaciones.php'; 
                    if (mysqli_num_rows($query) > 0):
                        while ($row = mysqli_fetch_array($query)): ?>
                            <tr>
                                <td><?= $row['id_habitacion']; ?></td>
                                <td><?= $row['numero']; ?></td>
                                <td><?= $row['categoria']; ?></td>
                                <td><?= $row['descripcion']; ?></td>
                                <td><?= $row['precio']; ?></td>
                                <td><?= $row['estado']; ?></td>
                                <td>
                                    <a href="editar_habitacion.php?id_habitacion=<?= $row['id_habitacion']; ?>" class="btn btn-sm btn-primary">Editar</a>
                                    <a href="eliminar_habitacion.php?id_habitacion=<?= $row['id_habitacion']; ?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                                        data-id="<?= $row['id_habitacion']; ?>">
                                            Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile;
                    else: ?>
                        <tr>
                            <td colspan="10" class="text-center">No hay habitaciones registradas</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
   
    <div class="modal fade" id="agregarHabitacionModal" tabindex="-1" aria-labelledby="agregarHabitacionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Encabezado del modal -->
        <div class="modal-header">
          <h5 class="modal-title" id="agregarHabitacionLabel">Agregar Habitaciom</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form method="POST" action="agregar_habitacion.php">
            <div class="mb-3">
              <label for="numero" class="form-label">Numero de habitacion</label>
              <input type="number" class="form-control" id="numero" name="numero" required>
            </div>
            
            <div class="mb-3">
              <label for="categoria" class="form-label">Categoria</label>
              <select class="form-select" id="categoria" name="categoria" required>
                <option value="">Selecciona una categoria</option>
                <option value="Simple">Simple</option>
                <option value="Matrimonial">Matrimonial</option>
                <option value="Deluxe">Deluxe</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>

            <div class="mb-3">
              <label for="numero" class="form-label">precio</label>
              <input type="number" class="form-control" id="precio" name="precio" required>
            </div>

            <div class="mb-3">
              <label for="estado" class="form-label">Estado</label>
              <select class="form-select" id="estado" name="estado" required>
                <option value="">Selecciona un estado</option>
                <option value="Disponible">Disponible</option>
                <option value="No disponible">No disponible</option>
              </select>
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
                
                <a href="eliminar_habitacion.php?id_habitacion=<?= $row['id_habitacion']; ?>" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
      </div>
    </div>


  <!-- Bootstrap JS y Iconos -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
  <script>
    
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        
        const button = event.relatedTarget;

        
        const id = button.getAttribute('data-id');

        
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        confirmDeleteButton.href = `eliminar_habitacion.php?id_habitacion=${id}`;
    });
  </script>
</body>
</html>
