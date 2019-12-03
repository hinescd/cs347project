<?php
require_once('db_connection.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'MANAGER') {
    echo 'Permission denied';
    exit;
}
if(empty($_GET['ta']) || empty($_GET['semester']) || empty($_GET['date']) || empty($_GET['start']) || empty($_GET['end']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'MANAGER') {
    echo 'Missing required fields';
    exit();
}

$conn = OpenCon();
$stmt = $conn->prepare('SELECT end FROM semester WHERE semesterID = ?');
$stmt->bind_param('i', $_GET['semester']);
$stmt->execute();
$semester_end = strtotime($stmt->get_result()->fetch_assoc()['end']);

$stmt = $conn->prepare('INSERT INTO shift (taID, semesterID, start, end) VALUES (?, ?, ?, ?)');
$date = strtotime($_GET['date']);

$start_time = explode(':', $_GET['start']);
$end_time = explode(':', $_GET['end']);

$insert = $date <= $semester_end;

while($insert) {
    $start = date('Y-m-d H:i', strtotime('+' . $start_time[0] . ' Hours ' . $start_time[1] . ' Minutes', $date));
    $end = date('Y-m-d H:i', strtotime('+' . $end_time[0] . ' Hours ' . $end_time[1] . ' Minutes', $date));
    $stmt->bind_param('iiss', $_GET['ta'], $_GET['semester'], $start, $end);
    $stmt->execute() or die('Shift creation failed: ' . $stmt->error);
    $date = strtotime('+1 Week', $date);
    $insert = $date <= $semester_end && isset($_GET['repeats']);
}

header('Location: /html/manager.php');
?>