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

$stmt = $conn->prepare('SELECT p.personID AS personID, p.name AS name, p.class AS class, s.start, s.end, s.cover_requested, c.personID AS coverer_personID, c.name AS coverer_name, c.class AS coverer_class FROM shift AS s JOIN person AS p ON p.personID = s.taID LEFT JOIN cover ON cover.shiftID = s.shiftID LEFT JOIN person AS c ON cover.covererID = c.personID WHERE MONTH(s.start) = ? AND YEAR(s.start) = ?');
$stmt->bind_param('ii', $month, $year);
$stmt->execute();
$result = $stmt->get_result();
$shifts = [];
while($row = $result->fetch_assoc()) {
    $shift = [];
    $shift['start'] = $row['start'];
    $shift['end'] = $row['end'];
    $name = $row['name'];
    $class = $row['class'];
    $personID = $row['personID'];
    if(isset($row['coverer_name'])) {
        $name = $row['coverer_name'];
        $class = $row['coverer_class'];
        $personID = $row['coverer_personID'];
    }
    if(isset($_SESSION['name'])) {
        $shift['displayName'] = explode(' ', $name)[0] . ' (' . $class . ')';
    } else {
        $shift['displayName'] = $class;
    }
    $shift['cover_requested'] = $row['cover_requested'];
    $shift['personID'] = $personID;
    array_push($shifts, $shift);
}
$result->close();
$stmt->close();
echo json_encode($shifts);
?>