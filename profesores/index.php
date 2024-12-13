<?php
include '../includes/db.php';

$sql = "SELECT * FROM Profesores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profesores</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Lista de Profesores</h1>
    <a href="create.php">Añadir Profesor</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Numero</th>
            <th>Profesion</th>
            <th>Clase Ofrece</th>
            <th>DNI</th>
            <th>Notas</th>
            <th>Costo Curso</th>
            <th>Materiales Solicitados</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['IDProfesores']; ?></td>
            <td><?php echo $row['Nombre']; ?></td>
            <td><?php echo $row['Numero']; ?></td>
            <td><?php echo $row['Profesion']; ?></td>
            <td><?php echo $row['ClaseOfrece']; ?></td>
            <td><?php echo $row['DNI']; ?></td>
            <td><?php echo $row['NotasP']; ?></td>
            <td><?php echo $row['Costo_Curso']; ?></td>
            <td><?php echo $row['Materiales_Solicitados']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['IDProfesores']; ?>">Editar</a>
                <a href="delete.php?id=<?php echo $row['IDProfesores']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este profesor?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>