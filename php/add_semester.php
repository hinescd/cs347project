<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'MANAGER') {
    echo 'Permission denied';
    exit;
}

if(!isset($_GET['start']) || !isset($_GET['end'])) {
    echo 'Start and end dates required';
    exit;
}

require_once('db_connection.php');

$conn = OpenCon();

$stmt = $conn->prepare('INSERT INTO semester (start, end) VALUES (?, ?)');
$stmt->bind_param('ss', $_GET['start'], $_GET['end']);
$stmt->execute() or die('Semester creation failed: ' . $conn->error);

header('Location: ../html/manager.php');
?>