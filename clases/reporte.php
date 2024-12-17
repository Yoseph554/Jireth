<?php
include '../includes/db.php';

$idClase = $_GET['id'];
$sqlClase = "SELECT Clases.ClaseSolicitada, Profesores.Nombre AS NombreProfesor 
             FROM Clases 
             JOIN Profesores ON Clases.IDProfesor = Profesores.IDProfesores 
             WHERE Clases.IDClase = $idClase";
$resultClase = $conn->query($sqlClase);
$clase = $resultClase->fetch_assoc();

$sqlAlumnos = "SELECT ClaseAlumno.IDClaseAlumno, Alumno.Nombre, ClaseAlumno.Examen1, ClaseAlumno.Examen2, ClaseAlumno.Examen3, ClaseAlumno.Examen4, ClaseAlumno.Proyecto, ClaseAlumno.FechaPago 
               FROM ClaseAlumno 
               JOIN Alumno ON ClaseAlumno.IDAlumno = Alumno.IDAlumno 
               WHERE ClaseAlumno.IDClase = $idClase";
$resultAlumnos = $conn->query($sqlAlumnos);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['notas'] as $idClaseAlumno => $notas) {
        $examen1 = $notas['examen1'];
        $examen2 = $notas['examen2'];
        $examen3 = $notas['examen3'];
        $examen4 = $notas['examen4'];
        $proyecto = $notas['proyecto'];
        $fechaPago = $_POST['fechasPago'][$idClaseAlumno];
        $sqlUpdate = "UPDATE ClaseAlumno SET Examen1='$examen1', Examen2='$examen2', Examen3='$examen3', Examen4='$examen4', Proyecto='$proyecto', FechaPago='$fechaPago' WHERE IDClaseAlumno=$idClaseAlumno";
        $conn->query($sqlUpdate);
    }
    header("Location: reporte.php?id=$idClase");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Alumnos</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="console">
        <h1>Reporte de Alumnos</h1>
        <h2>Profesor: <?php echo $clase['NombreProfesor']; ?></h2>
        <h2>Clase: <?php echo $clase['ClaseSolicitada']; ?></h2>
        <form method="POST">
            <table>
                <tr>
                    <th>NLista</th>
                    <th>Nombre</th>
                    <th>Examen 1</th>
                    <th>Examen 2</th>
                    <th>Examen 3</th>
                    <th>Examen 4</th>
                    <th>Proyecto</th>
                    <th>Fecha de Pago</th>
                </tr>
                <?php $nLista = 1; while($alumno = $resultAlumnos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $nLista++; ?></td>
                    <td><?php echo $alumno['Nombre']; ?></td>
                    <td>
                        <input type="number" step="0.01" name="notas[<?php echo $alumno['IDClaseAlumno']; ?>][examen1]" value="<?php echo $alumno['Examen1']; ?>">
                    </td>
                    <td>
                        <input type="number" step="0.01" name="notas[<?php echo $alumno['IDClaseAlumno']; ?>][examen2]" value="<?php echo $alumno['Examen2']; ?>">
                    </td>
                    <td>
                        <input type="number" step="0.01" name="notas[<?php echo $alumno['IDClaseAlumno']; ?>][examen3]" value="<?php echo $alumno['Examen3']; ?>">
                    </td>
                    <td>
                        <input type="number" step="0.01" name="notas[<?php echo $alumno['IDClaseAlumno']; ?>][examen4]" value="<?php echo $alumno['Examen4']; ?>">
                    </td>
                    <td>
                        <input type="number" step="0.01" name="notas[<?php echo $alumno['IDClaseAlumno']; ?>][proyecto]" value="<?php echo $alumno['Proyecto']; ?>">
                    </td>
                    <td>
                        <input type="date" name="fechasPago[<?php echo $alumno['IDClaseAlumno']; ?>]" value="<?php echo $alumno['FechaPago']; ?>">
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
            <button type="submit">Guardar Cambios</button>
            <button type="button" onclick="window.location.href='generar_reporte.php?id=<?php echo $idClase; ?>'">Imprimir Reporte</button>
        </form>
    </div>
</body>
</html>