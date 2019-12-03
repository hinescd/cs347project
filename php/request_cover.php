<?php
require_once('db_connection.php');
session_start();
if(empty($_GET['shift']) || !isset($_SESSION['personID'])) {
    http_response_code(400);
    exit();
}
$conn = OpenCon();
$stmt = $conn->prepare('SELECT taID FROM shift WHERE shiftID = ?');
$stmt->bind_param('i', $_GET['shift']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) {
    http_response_code(400);
    exit();
}
$shift = $result->fetch_assoc();
if($shift['taID'] != $_SESSION['personID']) {
    http_response_code(400);
    exit();
}
$stmt = $conn->prepare('UPDATE shift SET cover_requested = 1 WHERE shiftID = ?');
$stmt->bind_param('i', $_GET['shift']);
$stmt->execute();
if($stmt->affected_rows === 0) {
    http_response_code(400);
    exit();
}
?>