<?php
require_once('db_connection.php');

session_start();

$month = date('m');
$year = date('Y');

if(!empty($_GET['month']) && !empty($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
}

$conn = OpenCon();

if($conn->connect_errno) {
    printf('Connect failed: %s\n', $conn->connect_error);
    exit();
}

$stmt = $conn->prepare('SELECT p.name, p.class, s.start, s.end FROM shift AS s JOIN person AS p ON p.personID = s.taID WHERE MONTH(s.start) = ? AND YEAR(s.start) = ?');
$stmt->bind_param('ii', $month, $year);
$stmt->execute();
$result = $stmt->get_result();
$shifts = [];
while($row = $result->fetch_assoc()) {
    $shift = [];
    $shift['start'] = $row['start'];
    $shift['end'] = $row['end'];
    if(isset($_SESSION['name'])) {
        $shift['displayName'] = explode(' ', $row['name'])[0] . ' (' . $row['class'] . ')';
    } else {
        $shift['displayName'] = $row['class'];
    }
    array_push($shifts, $shift);
}
$result->close();
$stmt->close();
echo json_encode($shifts);
?>