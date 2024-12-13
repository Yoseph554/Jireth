<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $nivelAcademico = $_POST['nivelAcademico'];
    $claseSolicitada = $_POST['claseSolicitada'];
    $dni = $_POST['dni'];
    $matricula = $_POST['matricula'];
    $mensualidad = $_POST['mensualidad'];
    $notasA = $_POST['notasA'];

    $sql = "INSERT INTO Alumno (Nombre, Numero, Nivel_Academico, ClaseSolicitada, DNI, Matricula, Mensualidad, NotasA)
            VALUES ('$nombre', '$numero', '$nivelAcademico', '$claseSolicitada', '$dni', '$matricula', '$mensualidad', '$notasA')";

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
    <title>Añadir Alumno</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Añadir Alumno</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="numero">Numero:</label>
        <input type="text" id="numero" name="numero" required>
        <label for="nivelAcademico">Nivel Académico:</label>
        <input type="text" id="nivelAcademico" name="nivelAcademico" required>
        <label for="claseSolicitada">Clase Solicitada:</label>
        <input type="text" id="claseSolicitada" name="claseSolicitada" required>
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required>
        <label for="matricula">Matrícula:</label>
        <input type="number" step="0.01" id="matricula" name="matricula" required>
        <label for="mensualidad">Mensualidad:</label>
        <input type="number" step="0.01" id="mensualidad" name="mensualidad" required>
        <label for="notasA">Notas:</label>
        <textarea id="notasA" name="notasA"></textarea>
        <button type="submit">Añadir</button>
    </form>
</body>
</html>