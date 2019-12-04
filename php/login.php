<?php
require_once('db_connection.php');

function login() {
  if(empty($_POST['email'])) {
    return 'Email is required';
  }
  if(empty($_POST['password'])) {
    return 'Password is required';
  }
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $conn = OpenCon();
  $stmt = $conn->prepare('SELECT personID, name, role, password_hash FROM person WHERE email = ?');
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows === 0) {
    $stmt->close();
    $conn->close();
    return 'Given credentials did not match an existing account';
  } else {
    $user = $result->fetch_assoc();
    if(!isset($user['password_hash'])) {
      $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
      $set_pass_stmt = $conn->prepare('UPDATE person SET password_hash = ? WHERE personID = ?');
      $set_pass_stmt->bind_param('si', $pass_hash, $user['personID']);
      $set_pass_stmt->execute();
      $set_pass_stmt->close();
      $_SESSION['name'] = $user['name'];
      $_SESSION['personID'] = $user['personID'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['password_hash'] = $pass_hash;
      $stmt->close();
      $conn->close();
    } else if(password_verify($pass, $user['password_hash'])) {
      $_SESSION['name'] = $user['name'];
      $_SESSION['personID'] = $user['personID'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['password_hash'] = $user['password_hash'];
      $stmt->close();
      $conn->close();
      return;
    } else {
      $stmt->close();
      $conn->close();
      return 'Given credentials did not match an existing account';
    }
  }
}
?>
