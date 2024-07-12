<?php
$servername = "localhost";
$username = "panteras";
$password = "root";
$database = "panteras";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener datos de la tabla visitas
$sql = "SELECT * FROM visitas";
$result = $conn->query($sql);

// Comprobar si hay resultados y mostrar en la tabla
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet"> <!-- Referencia al archivo CSS externo -->
  </head>
  <body>
    <header>
      <h2>Visitas a museos</h2>
    </header>
    <form method="post" action="">
      <div class="container mt-3">
        <div class="row">
          <div class="col-md-12 d-flex justify-content-center">
            <div class="search-container">
              <button class="search-button">Buscar</button>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 1</option>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 2</option>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 3</option>
            </select>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 4</option>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 5</option>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 6</option>
            </select>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 7</option>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 8</option>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 9</option>
            </select>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 10</option>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 11</option>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select custom-select">
              <option value="">Filtro 12</option>
            </select>
          </div>
        </div>
      </div>
      <div class="container mt-3 alert-container">
        <div class="alert custom-alert" role="alert">
          <div class="row">
            <div class="col-md-2">
              <div class="alert-section custom-alert-sections">
                <div class="alert-text custom-alert-text-margin">Visitas</div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="alert-section custom-alert-sections">
                <div class="alert-text custom-alert-text-margin">No. Nacionales</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="alert-section custom-alert-sections">
                <div class="alert-text custom-alert-text-margin">No. Extranjeros</div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="alert-section custom-alert-sections">
                <div class="alert-text custom-alert-text-margin">Primera lengua</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="alert-section custom-alert-sections">
                <div class="alert-text custom-alert-text-margin">Segunda lengua</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="container mt-3 d-flex full-height">
      <div class="m-auto card overflow-x-auto invisible-header invisible-thing custom-tbody"> 
        <table id="data-table" class="table table-custom no-border">
        <thead>
            <tr>
              <th>Estado</th>
              <th>Sexo</th>
              <th>Edad</th>
              <th>País de Residencia</th>
              <th>Nacionalidad</th>
              <th>Escolaridad</th>
              <th>Estado Escolar</th>
              <th>1ra Lengua</th>
              <th>2da Lengua</th>
              <th>Frecuencia</th>
              <th>Medio de Comunicación</th>
              <th>Motivo de Visita</th>
              <th>Medio de Transporte</th>
              <th>Tiempo de Traslado</th>
              <th>Tipo de Acompañantes</th>
              <th>Tamaño del Grupo</th>
              <th>Menores de 12 en el Grupo</th>
              <th>Duración de Visita [min]</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Comprobar si hay resultados y mostrar en la tabla
            if ($result->num_rows > 0) {
                // Iterar sobre los datos y mostrar cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['estado'] . "</td>";
                    echo "<td>" . $row['sexo'] . "</td>";
                    echo "<td>" . $row['edad'] . "</td>";
                    echo "<td>" . $row['residencia'] . "</td>";
                    echo "<td>" . $row['nacionalidad'] . "</td>";
                    echo "<td>" . $row['escolaridad'] . "</td>";
                    echo "<td>" . $row['estado_escolar'] . "</td>";
                    echo "<td>" . $row['primera_leng'] . "</td>";
                    echo "<td>" . $row['segunda_leng'] . "</td>";
                    echo "<td>" . $row['frecuencia_visita'] . "</td>";
                    echo "<td>" . $row['medio_com'] . "</td>";
                    echo "<td>" . $row['motivo'] . "</td>";
                    echo "<td>" . $row['medio_transporte'] . "</td>";
                    echo "<td>" . $row['tiempo_traslado'] . "</td>";
                    echo "<td>" . $row['tipo_grupo'] . "</td>";
                    echo "<td>" . $row['tamaño_grupo'] . "</td>";
                    echo "<td>" . $row['menores_grupo'] . "</td>";
                    echo "<td>" . $row['duracion'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='17'>0 resultados</td></tr>";
            }

            // Cerrar conexión
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
