<?php
include '../includes/db.php';

$sql = "SELECT Clases.IDClase, Profesores.Nombre AS NombreProfesor, Profesores.Numero AS NumeroProfesor, Profesores.Profesion, Clases.ClaseSolicitada, Clases.Matriculados, Clases.Mensualidad, Clases.Materiales_Solicitados 
        FROM Clases 
        JOIN Profesores ON Clases.IDProfesor = Profesores.IDProfesores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clases</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Lista de Clases</h1>
    <a href="create.php">Añadir Ficha</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre Profesor</th>
            <th>Numero de Profesor</th>
            <th>Profesion</th>
            <th>Clase Solicitada</th>
            <th>Matriculados</th>
            <th>Mensualidad</th>
            <th>Materiales Solicitados</th>
            <th>Reporte Alumnos</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['IDClase']; ?></td>
            <td><?php echo $row['NombreProfesor']; ?></td>
            <td><?php echo $row['NumeroProfesor']; ?></td>
            <td><?php echo $row['Profesion']; ?></td>
            <td><?php echo $row['ClaseSolicitada']; ?></td>
            <td><?php echo $row['Matriculados']; ?></td>
            <td><?php echo $row['Mensualidad']; ?></td>
            <td><?php echo $row['Materiales_Solicitados']; ?></td>
            <td><a href="reporte.php?id=<?php echo $row['IDClase']; ?>">Reporte</a></td>
            <td>
                <a href="edit.php?id=<?php echo $row['IDClase']; ?>">Editar</a>
                <a href="delete.php?id=<?php echo $row['IDClase']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta clase?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>