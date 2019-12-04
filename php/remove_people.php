
<?php
    session_start();
    require_once('db_connection.php');
    $connection = OpenCon();

    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }

    if((!empty($_POST['password'])) && (!empty($_POST['email']))) {
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        if(password_verify($password, $_SESSION['password_hash'])) {
            $person = $connection->prepare('SELECT name FROM person WHERE email = ?');
            $person->bind_param("s", $email);
            $person->execute();
            $result = $person->get_result();
            $user = $result->fetch_assoc();

            $removePersonQuery = $connection->prepare("DELETE FROM person WHERE email = ?");
            $removePersonQuery->bind_param("s", $email);
            Echo "<html>";
            $removePersonQuery->execute();
            if ($removePersonQuery->affected_rows === 0) {
                Echo "<h1>Failed to remove person from the database.</h1>";
            } else {
                Echo "<h1>Person removed:</h1>";
                Echo "<h2>Name: ".$user['name']."</h2>";
                Echo "<h2>email: $email</h2>";
            }
            Echo "</html>";
        } else {
            Echo "<html><h1>Incorrect password.</h1></html>";
        }
    } else {
        Echo "<html><h1>Invalid Input</h1></html>";
    }
    CloseCon($connection);
?>
