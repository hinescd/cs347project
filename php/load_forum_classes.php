<?php
    require_once("db_connection.php");
    $connection = OpenCon();

    $query = "SELECT * FROM classForum";
    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }
    $forums = array();
    if ($result = $connection->query($query)) {
        while($item = $result->fetch_assoc()) {
            $forums[] = $item;
        }
        /* free result set */
        $result->close();
        echo json_encode($forums);
    }

    CloseCon($connection);
?>
