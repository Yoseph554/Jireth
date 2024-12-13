<?php
include '../includes/db.php';

$idClase = $_GET['id'];
$sqlClase = "SELECT Clases.ClaseSolicitada, Profesores.Nombre AS NombreProfesor 
             FROM Clases 
             JOIN Profesores ON Clases.IDProfesor = Profesores.IDProfesores 
             WHERE Clases.IDClase = $idClase";
$resultClase = $conn->query($sqlClase);
$clase = $resultClase->fetch_assoc();

$sqlAlumnos = "SELECT ClaseAlumno.IDClaseAlumno, Alumno.Nombre, ClaseAlumno.Nota, ClaseAlumno.FechaPago 
               FROM ClaseAlumno 
               JOIN Alumno ON ClaseAlumno.IDAlumno = Alumno.IDAlumno 
               WHERE ClaseAlumno.IDClase = $idClase";
$resultAlumnos = $conn->query($sqlAlumnos);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['notas'] as $idClaseAlumno => $nota) {
        $fechaPago = $_POST['fechasPago'][$idClaseAlumno];
        $sqlUpdate = "UPDATE ClaseAlumno SET Nota='$nota', FechaPago='$fechaPago' WHERE IDClaseAlumno=$idClaseAlumno";
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
    <h1>Reporte de Alumnos</h1>
    <h2>Profesor: <?php echo $clase['NombreProfesor']; ?></h2>
    <h2>Clase: <?php echo $clase['ClaseSolicitada']; ?></h2>
    <form method="POST">
        <table>
            <tr>
                <th>NLista</th>
                <th>Nombre</th>
                <th>Nota</th>
                <th>Fecha de Pago</th>
            </tr>
            <?php $nLista = 1; while($alumno = $resultAlumnos->fetch_assoc()): ?>
            <tr>
                <td><?php echo $nLista++; ?></td>
                <td><?php echo $alumno['Nombre']; ?></td>
                <td>
                    <input type="number" step="0.01" name="notas[<?php echo $alumno['IDClaseAlumno']; ?>]" value="<?php echo $alumno['Nota']; ?>">
                </td>
                <td>
                    <input type="date" name="fechasPago[<?php echo $alumno['IDClaseAlumno']; ?>]" value="<?php echo $alumno['FechaPago']; ?>">
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>