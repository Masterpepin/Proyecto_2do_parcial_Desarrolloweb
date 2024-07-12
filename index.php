<?php
$servername = "localhost";
$username = "panteras";
$password = "root";
$database = "panteras";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$columns = [
  'transportes' => 'transporte',
  'relacion' => 'relacion',
  'motivo' => 'motivos',
  'paises' => 'pais',
  'gentilicio' => 'pais',
  'idioma' => 'lenguaje',
  'rango' => 'frec_visita',
  'estados' => 'estado',
  'medio' => 'comunicacion',
  'grado' => 'escolaridad',
  'edad' => 'visitas'
];

$options = [];

foreach ($columns as $column => $table) {
    $sql = "SELECT DISTINCT $column FROM $table";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[$column][] = $row[$column];
        }
    } else {
        $options[$column] = [];
    }
}

$sql = "SELECT 
            visitas.estado,
            visitas.sexo,
            visitas.edad,
            visitas.residencia,
            visitas.nacionalidad,
            visitas.escolaridad,
            visitas.estado_escolar,
            visitas.primera_leng,
            visitas.segunda_leng,
            visitas.frecuencia_visita,
            visitas.medio_com,
            visitas.motivo,
            visitas.medio_transporte,
            visitas.tiempo_traslado,
            visitas.tipo_grupo,
            visitas.tamaño_grupo,
            visitas.menores_grupo,
            visitas.duracion,
            estado.estados AS estado_nombre,
            pais.paises AS pais_nombre,
            pais.Gentilicio AS pais_gentilicio,
            escolaridad.Grado AS escolaridad_nombre,
            frec_visita.Rango AS frec_visita_nombre,
            lenguaje1.idioma AS primera_leng_nombre,
            lenguaje2.idioma AS segunda_leng_nombre,
            comunicacion.Medio AS medio_com_nombre,
            motivos.Motivo AS motivo_nombre,
            transporte.transportes AS medio_transporte_nombre,
            relacion.relacion AS relacion_nombre
        FROM visitas
        LEFT JOIN estado ON visitas.estado = estado.ID
        LEFT JOIN pais ON visitas.residencia = pais.ID
        LEFT JOIN escolaridad ON visitas.escolaridad = escolaridad.ID
        LEFT JOIN frec_visita ON visitas.frecuencia_visita = frec_visita.ID
        LEFT JOIN lenguaje AS lenguaje1 ON visitas.primera_leng = lenguaje1.ID
        LEFT JOIN lenguaje AS lenguaje2 ON visitas.segunda_leng = lenguaje2.ID
        LEFT JOIN comunicacion ON visitas.medio_com = comunicacion.ID
        LEFT JOIN motivos ON visitas.motivo = motivos.ID
        LEFT JOIN transporte ON visitas.medio_transporte = transporte.ID
        LEFT JOIN relacion ON visitas.tipo_grupo = relacion.ID";

$filters = [];
foreach ($columns as $column => $table) {
    if (isset($_POST[$column]) && !empty($_POST[$column])) {
        $value = $conn->real_escape_string($_POST[$column]);
        $filters[] = "$table.$column = '$value'";
    }
}

if (!empty($filters)) {
    $sql .= " WHERE " . implode(" AND ", $filters);
}

$result = $conn->query($sql);
$num_rows = $result->num_rows;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <h2>Visitas a museos</h2>
    </header>
    <form method="post" action="">
        <div class="container-filtros">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="search-container">
                            <button class="search-button">Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-7 d-flex justify-content-end">
                        <a href="#" id="toggle-filters" class="text-decoration-none">
                            Mostrar/Ocultar Filtros <span class="rotate-icon" id="toggle-icon">▼</span>
                        </a>
                    </div>
                </div>
                <div class="row mt-3" id="filters">
                    <?php foreach ($columns as $column => $table): ?>
                        <div class="col-md-4">
                            <label for="<?= $column ?>"><?= ucfirst(str_replace('_', ' ', $column)) ?></label>
                            <select name="<?= $column ?>" class="form-select custom-select">
                                <option value="">Seleccione una opción</option>
                                <?php foreach ($options[$column] as $option): ?>
                                    <option value="<?= $option ?>"><?= $option ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="container mt-3 alert-container">
            <div class="alert custom-alert" role="alert">
                <div class="row">
                    <div class="col-md-2">
                        <div class="alert-section custom-alert-sections">
                            <div class="alert-text custom-alert-text-margin"><strong id="total-visitas">0</strong><br>Visitas</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="alert-section custom-alert-sections">
                            <div class="alert-text custom-alert-text-margin"><strong id="nacionales">0</strong><br>No. Nacionales</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert-section custom-alert-sections">
                            <div class="alert-text custom-alert-text-margin"><strong id="extranjeros">0</strong><br>No. Extranjeros</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="alert-section custom-alert-sections">
                            <div class="alert-text custom-alert-text-margin"><strong id="primera-leng">0</strong><br>Primera lengua</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert-section custom-alert-sections">
                            <div class="alert-text custom-alert-text-margin"><strong id="segunda-leng">0</strong><br>Segunda lengua</div>
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
                        <th>Número de Personas</th>
                        <th>Menores de Edad</th>
                        <th>Duración de Visita</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['estado_nombre'] . "</td>";
                            echo "<td>" . $row['sexo'] . "</td>";
                            echo "<td>" . $row['edad'] . "</td>";
                            echo "<td>" . $row['pais_nombre'] . "</td>";
                            echo "<td>" . $row['pais_gentilicio'] . "</td>";
                            echo "<td>" . $row['escolaridad_nombre'] . "</td>";
                            echo "<td>" . $row['estado_escolar'] . "</td>";
                            echo "<td>" . $row['primera_leng_nombre'] . "</td>";
                            echo "<td>" . $row['segunda_leng_nombre'] . "</td>";
                            echo "<td>" . $row['frec_visita_nombre'] . "</td>";
                            echo "<td>" . $row['medio_com_nombre'] . "</td>";
                            echo "<td>" . $row['motivo_nombre'] . "</td>";
                            echo "<td>" . $row['medio_transporte_nombre'] . "</td>";
                            echo "<td>" . $row['tiempo_traslado'] . "</td>";
                            echo "<td>" . $row['relacion_nombre'] . "</td>";
                            echo "<td>" . $row['tamaño_grupo'] . "</td>";
                            echo "<td>" . $row['menores_grupo'] . "</td>";
                            echo "<td>" . $row['duracion'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='18' class='text-center'>No se encontraron resultados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-wEmeIV1mKuiNp12S8gK3JIbT2W5iC2RmFw5mCv1Wg87kci3JH9wwJDehZ7erwB4M" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
