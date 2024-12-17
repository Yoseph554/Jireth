<?php
include '../includes/db.php';
require '../vendor/autoload.php'; // Asegúrate de que la ruta es correcta

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$idClase = $_GET['id'];
$sqlClase = "SELECT Clases.ClaseSolicitada, Profesores.Nombre AS NombreProfesor 
             FROM Clases 
             JOIN Profesores ON Clases.IDProfesor = Profesores.IDProfesores 
             WHERE Clases.IDClase = $idClase";
$resultClase = $conn->query($sqlClase);
$clase = $resultClase->fetch_assoc();

$sqlAlumnos = "SELECT Alumno.Nombre, ClaseAlumno.Examen1, ClaseAlumno.Examen2, ClaseAlumno.Examen3, ClaseAlumno.Examen4, ClaseAlumno.Proyecto, ClaseAlumno.FechaPago 
               FROM ClaseAlumno 
               JOIN Alumno ON ClaseAlumno.IDAlumno = Alumno.IDAlumno 
               WHERE ClaseAlumno.IDClase = $idClase";
$resultAlumnos = $conn->query($sqlAlumnos);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Reporte de Alumnos');

// Encabezados
$sheet->setCellValue('A1', 'NLista');
$sheet->setCellValue('B1', 'Nombre');
$sheet->setCellValue('C1', 'Examen 1');
$sheet->setCellValue('D1', 'Examen 2');
$sheet->setCellValue('E1', 'Examen 3');
$sheet->setCellValue('F1', 'Examen 4');
$sheet->setCellValue('G1', 'Proyecto');
$sheet->setCellValue('H1', 'Fecha de Pago');

// Datos
$nLista = 1;
$row = 2;
while ($alumno = $resultAlumnos->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $nLista++);
    $sheet->setCellValue('B' . $row, $alumno['Nombre']);
    $sheet->setCellValue('C' . $row, $alumno['Examen1']);
    $sheet->setCellValue('D' . $row, $alumno['Examen2']);
    $sheet->setCellValue('E' . $row, $alumno['Examen3']);
    $sheet->setCellValue('F' . $row, $alumno['Examen4']);
    $sheet->setCellValue('G' . $row, $alumno['Proyecto']);
    $sheet->setCellValue('H' . $row, $alumno['FechaPago']);
    $row++;
}

// Generar archivo Excel
$writer = new Xlsx($spreadsheet);
$filename = 'Reporte_Alumnos_' . $idClase . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>