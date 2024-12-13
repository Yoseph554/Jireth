<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $profesion = $_POST['profesion'];
    $claseOfrece = $_POST['claseOfrece'];
    $dni = $_POST['dni'];
    $notasP = $_POST['notasP'];
    $costoCurso = $_POST['costoCurso'];
    $materialesSolicitados = $_POST['materialesSolicitados'];

    $sql = "INSERT INTO Profesores (Nombre, Numero, Profesion, ClaseOfrece, DNI, NotasP, Costo_Curso, Materiales_Solicitados)
            VALUES ('$nombre', '$numero', '$profesion', '$claseOfrece', '$dni', '$notasP', '$costoCurso', '$materialesSolicitados')";

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
    <title>Añadir Profesor</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Añadir Profesor</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="numero">Numero:</label>
        <input type="text" id="numero" name="numero" required>
        <label for="profesion">Profesion:</label>
        <input type="text" id="profesion" name="profesion" required>
        <label for="claseOfrece">Clase Ofrece:</label>
        <input type="text" id="claseOfrece" name="claseOfrece" required>
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required>
        <label for="notasP">Notas:</label>
        <textarea id="notasP" name="notasP"></textarea>
        <label for="costoCurso">Costo Curso:</label>
        <input type="number" step="0.01" id="costoCurso" name="costoCurso" required>
        <label for="materialesSolicitados">Materiales Solicitados:</label>
        <textarea id="materialesSolicitados" name="materialesSolicitados"></textarea>
        <button type="submit">Añadir</button>
    </form>
</body>
</html>