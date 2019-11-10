<?php
    require_once("db_connection.php");
    $connection = OpenCon();

    $query = "SELECT CF.forumID, questionID,  details, asked, author FROM classforum CF LEFT JOIN question Q1 ON CF.forumID = Q1.forumID WHERE questionID = (SELECT MAX(Q2.questionID) FROM question Q2 WHERE Q1.forumID = Q2.forumID) GROUP BY CF.forumID";
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
