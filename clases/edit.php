<?php
include '../includes/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM Clases WHERE IDClase = $id";
$result = $conn->query($sql);
$clase = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProfesor = $_POST['idProfesor'];
    $claseSolicitada = $_POST['claseSolicitada'];
    $matriculados = $_POST['matriculados'];
    $mensualidad = $_POST['mensualidad'];
    $materialesSolicitados = $_POST['materialesSolicitados'];

    $sql = "UPDATE Clases SET 
            IDProfesor='$idProfesor', 
            ClaseSolicitada='$claseSolicitada', 
            Matriculados='$matriculados', 
            Mensualidad='$mensualidad', 
            Materiales_Solicitados='$materialesSolicitados' 
            WHERE IDClase=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sqlProfesores = "SELECT * FROM Profesores";
$resultProfesores = $conn->query($sqlProfesores);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Clase</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Clase</h1>
    <form method="POST">
        <label for="idProfesor">Profesor:</label>
        <select id="idProfesor" name="idProfesor" required>
            <?php while($profesor = $resultProfesores->fetch_assoc()): ?>
                <option value="<?php echo $profesor['IDProfesores']; ?>" <?php if($profesor['IDProfesores'] == $clase['IDProfesor']) echo 'selected'; ?>>
                    <?php echo $profesor['Nombre']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="claseSolicitada">Clase Solicitada:</label>
        <input type="text" id="claseSolicitada" name="claseSolicitada" value="<?php echo $clase['ClaseSolicitada']; ?>" required>
        <label for="matriculados">Matriculados:</label>
        <input type="number" id="matriculados" name="matriculados" value="<?php echo $clase['Matriculados']; ?>" required>
        <label for="mensualidad">Mensualidad:</label>
        <input type="number" step="0.01" id="mensualidad" name="mensualidad" value="<?php echo $clase['Mensualidad']; ?>" required>
        <label for="materialesSolicitados">Materiales Solicitados:</label>
        <textarea id="materialesSolicitados" name="materialesSolicitados"><?php echo $clase['Materiales_Solicitados']; ?></textarea>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>