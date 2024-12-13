<?php
include '../includes/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM Profesores WHERE IDProfesores = $id";
$result = $conn->query($sql);
$profesor = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $profesion = $_POST['profesion'];
    $claseOfrece = $_POST['claseOfrece'];
    $dni = $_POST['dni'];
    $notasP = $_POST['notasP'];
    $costoCurso = $_POST['costoCurso'];
    $materialesSolicitados = $_POST['materialesSolicitados'];

    $sql = "UPDATE Profesores SET 
            Nombre='$nombre', 
            Numero='$numero', 
            Profesion='$profesion', 
            ClaseOfrece='$claseOfrece', 
            DNI='$dni', 
            NotasP='$notasP', 
            Costo_Curso='$costoCurso', 
            Materiales_Solicitados='$materialesSolicitados' 
            WHERE IDProfesores=$id";

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
    <title>Editar Profesor</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Profesor</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $profesor['Nombre']; ?>" required>
        <label for="numero">Numero:</label>
        <input type="text" id="numero" name="numero" value="<?php echo $profesor['Numero']; ?>" required>
        <label for="profesion">Profesion:</label>
        <input type="text" id="profesion" name="profesion" value="<?php echo $profesor['Profesion']; ?>" required>
        <label for="claseOfrece">Clase Ofrece:</label>
        <input type="text" id="claseOfrece" name="claseOfrece" value="<?php echo $profesor['ClaseOfrece']; ?>" required>
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" value="<?php echo $profesor['DNI']; ?>" required>
        <label for="notasP">Notas:</label>
        <textarea id="notasP" name="notasP"><?php echo $profesor['NotasP']; ?></textarea>
        <label for="costoCurso">Costo Curso:</label>
        <input type="number" step="0.01" id="costoCurso" name="costoCurso" value="<?php echo $profesor['Costo_Curso']; ?>" required>
        <label for="materialesSolicitados">Materiales Solicitados:</label>
        <textarea id="materialesSolicitados" name="materialesSolicitados"><?php echo $profesor['Materiales_Solicitados']; ?></textarea>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>