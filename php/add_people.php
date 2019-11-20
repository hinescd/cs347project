
<?php
    require_once('db_connection.php');
    $connection = OpenCon();

    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }

    if((!empty($_POST['name'])) && (!empty($_POST['email']))) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['exampleRadios'];
        
        if($role == 'TA') {
            $course = $_POST['course'];
            $addPersonQuery = "INSERT INTO person(name, email, role, class) VALUES (\"".$name."\", \"".$email."\", \"".$role."\", \"".$course."\")";
        } else {
            $addPersonQuery = "INSERT INTO person(name, email, role) VALUES (\"".$name."\", \"".$email."\", \"".$role."\")";
        }

        Echo "<html>";
        if ($connection->query($addPersonQuery)) {
            Echo "<h1>Person added:</h1>";
            Echo "<h2>Name: $name</h2>";
            Echo "<h2>email: $email</h2>";
            Echo "<h2>role: $role</h2>";
        } else {
            Echo "<h1>Failed to add person into the database.</h1>";
        }
        Echo "</html>";
    }
    CloseCon($connection);
?>
