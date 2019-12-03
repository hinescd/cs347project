
<?php
    require_once('db_connection.php');
    $connection = OpenCon();

    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }

    if((!empty($_POST['password'])) && (!empty($_POST['email']))) {
        $password = $_POST['password'];
        $email = "jane@doe.com";
        
        if($password == "placeholder") {
            $removePersonQuery = $connection->prepare("DELETE FROM person WHERE email = ?");
            $removePersonQuery->bind_param("s", $email);
            Echo "<html>";
            if ($removePersonQuery->execute() or die($removePersonQuery->error)) {
                Echo "<h1>Person removed:</h1>";
                Echo "<h2>Name: placeholder</h2>";
                Echo "<h2>email: $email</h2>";
            } else {
                Echo "<h1>Failed to remove person from the database.</h1>";
            }
            Echo "</html>";
        } else {
            Echo "<html><h1>Incorrect password.</h1></html>";
        }
    }
    CloseCon($connection);
?>
