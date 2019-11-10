<?php
    require_once("db_connection.php");
    $connection = OpenCon();

    $forumQuery = "SELECT forumID, COUNT(questionID) AS \"numQuestions\" FROM question GROUP BY forumID";
    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }
    $forums = array();
    if ($result = $connection->query($forumQuery)) {
        while($forum = $result->fetch_assoc()) {
            $forums[] = $forum;
        }
        /* free result set */
        $result->close();
        echo json_encode($forums);
    }

    CloseCon($connection);
?>
