<?php
include '../includes/db.php';

$sql = "SELECT * FROM Alumno";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumnos</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="console">
        <h1>Lista de Alumnos</h1>
        <a href="create.php"><img src="../images/add.png" alt="Añadir Alumno" class="icon"> Añadir Alumno</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Numero</th>
                <th>Nivel Académico</th>
                <th>Clase Solicitada</th>
                <th>DNI</th>
                <th>Matrícula</th>
                <th>Mensualidad</th>
                <th>Notas</th>
                <th>Acciones</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['IDAlumno']; ?></td>
                <td><?php echo $row['Nombre']; ?></td>
                <td><?php echo $row['Numero']; ?></td>
                <td><?php echo $row['Nivel_Academico']; ?></td>
                <td><?php echo $row['ClaseSolicitada']; ?></td>
                <td><?php echo $row['DNI']; ?></td>
                <td><?php echo $row['Matricula']; ?></td>
                <td><?php echo $row['Mensualidad']; ?></td>
                <td><?php echo $row['NotasA']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['IDAlumno']; ?>"><img src="../images/edit.png" alt="Editar" class="icon"></a>
                    <a href="delete.php?id=<?php echo $row['IDAlumno']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este alumno?');"><img src="../images/delete.png" alt="Eliminar" class="icon"></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>