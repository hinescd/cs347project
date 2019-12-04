<?php
session_start();
if(empty($_GET['shift']) || empty($_GET['coverer']) || $_SESSION['role'] != 'MANAGER') {
    http_response_code(400);
    echo 'Bad';
    exit();
}

require_once('db_connection.php');
$conn = OpenCon();
$stmt = $conn->prepare('UPDATE cover SET approvedBy = ? WHERE shiftID = ? AND covererID = ?');
$stmt->bind_param('iii', $_SESSION['personID'], $_GET['shift'], $_GET['coverer']);
$stmt->execute();
if($stmt->affected_rows === 0) {
    http_response_code(400);
    echo 'None';
}
?>