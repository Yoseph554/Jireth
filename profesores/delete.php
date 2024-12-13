<?php
include '../includes/db.php';

$id = $_GET['id'];

$sql = "DELETE FROM Profesores WHERE IDProfesores = $id";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>