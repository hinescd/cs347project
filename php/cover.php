<?php
require_once('db_connection.php');
session_start();
if(empty($_GET['shift']) || !isset($_SESSION['personID'])) {
    http_response_code(400);
    exit();
}
$conn = OpenCon();
$stmt = $conn->prepare('INSERT INTO cover (shiftID, covererID) VALUES (?, ?)');
$stmt->bind_param('ii', $_GET['shift'], $_SESSION['personID']);
$stmt->execute();
if($stmt->rows_affected === 0) {
    http_response_code(400);
    exit();
}
?>