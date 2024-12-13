<?php
include '../includes/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM Alumno WHERE IDAlumno = $id";
$result = $conn->query($sql);
$alumno = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $nivelAcademico = $_POST['nivelAcademico'];
    $claseSolicitada = $_POST['claseSolicitada'];
    $dni = $_POST['dni'];
    $matricula = $_POST['matricula'];
    $mensualidad = $_POST['mensualidad'];
    $notasA = $_POST['notasA'];

    $sql = "UPDATE Alumno SET 
            Nombre='$nombre', 
            Numero='$numero', 
            Nivel_Academico='$nivelAcademico', 
            ClaseSolicitada='$claseSolicitada', 
            DNI='$dni', 
            Matricula='$matricula', 
            Mensualidad='$mensualidad', 
            NotasA='$notasA' 
            WHERE IDAlumno=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Alumno</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $alumno['Nombre']; ?>" required>
        <label for="numero">Numero:</label>
        <input type="text" id="numero" name="numero" value="<?php echo $alumno['Numero']; ?>" required>
        <label for="nivelAcademico">Nivel Académico:</label>
        <input type="text" id="nivelAcademico" name="nivelAcademico" value="<?php echo $alumno['Nivel_Academico']; ?>" required>
        <label for="claseSolicitada">Clase Solicitada:</label>
        <input type="text" id="claseSolicitada" name="claseSolicitada" value="<?php echo $alumno['ClaseSolicitada']; ?>" required>
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" value="<?php echo $alumno['DNI']; ?>" required>
        <label for="matricula">Matrícula:</label>
        <input type="number" step="0.01" id="matricula" name="matricula" value="<?php echo $alumno['Matricula']; ?>" required>
        <label for="mensualidad">Mensualidad:</label>
        <input type="number" step="0.01" id="mensualidad" name="mensualidad" value="<?php echo $alumno['Mensualidad']; ?>" required>
        <label for="notasA">Notas:</label>
        <textarea id="notasA" name="notasA"><?php echo $alumno['NotasA']; ?></textarea>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>