<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProfesor = $_POST['idProfesor'];
    $claseSolicitada = $_POST['claseSolicitada'];
    $matriculados = $_POST['matriculados'];
    $mensualidad = $_POST['mensualidad'];
    $materialesSolicitados = $_POST['materialesSolicitados'];

    $sql = "INSERT INTO Clases (IDProfesor, ClaseSolicitada, Matriculados, Mensualidad, Materiales_Solicitados)
            VALUES ('$idProfesor', '$claseSolicitada', '$matriculados', '$mensualidad', '$materialesSolicitados')";

    if ($conn->query($sql) === TRUE) {
        $idClase = $conn->insert_id;
        $sqlAlumnos = "SELECT IDAlumno FROM Alumno WHERE ClaseSolicitada = '$claseSolicitada'";
        $resultAlumnos = $conn->query($sqlAlumnos);
        while ($alumno = $resultAlumnos->fetch_assoc()) {
            $sqlInsertClaseAlumno = "INSERT INTO ClaseAlumno (IDClase, IDAlumno, Nota, FechaPago) VALUES ('$idClase', '".$alumno['IDAlumno']."', 0, CURDATE())";
            $conn->query($sqlInsertClaseAlumno);
        }
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
    <title>Añadir Clase</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Añadir Clase</h1>
    <form method="POST">
        <label for="idProfesor">Profesor:</label>
        <select id="idProfesor" name="idProfesor" required>
            <?php while($profesor = $resultProfesores->fetch_assoc()): ?>
                <option value="<?php echo $profesor['IDProfesores']; ?>"><?php echo $profesor['Nombre']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="claseSolicitada">Clase Solicitada:</label>
        <input type="text" id="claseSolicitada" name="claseSolicitada" required>
        <label for="matriculados">Matriculados:</label>
        <input type="number" id="matriculados" name="matriculados" required>
        <label for="mensualidad">Mensualidad:</label>
        <input type="number" step="0.01" id="mensualidad" name="mensualidad" required>
        <label for="materialesSolicitados">Materiales Solicitados:</label>
        <textarea id="materialesSolicitados" name="materialesSolicitados"></textarea>
        <button type="submit">Añadir</button>
    </form>
</body>
</html>