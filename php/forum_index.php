
<table id="forum_index" class="table table-striped table-responsive">
<thead class="thead-light">
    <tr>
        <th class="col-sm-2">Forum</th>
        <th class="col">Latest Question</th>
        <th class="col">Questions</th>
        <th class="col">Posts</th>
    </tr>
</thead>
<tbody>
    <?php
    require_once('db_connection.php');
    $connection = OpenCon();

    # Query classes and store them
    $classQuery = "SELECT * FROM classforum";
    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }
    $forums = array();
    if ($result = $connection->query($classQuery)) {
        while($item = $result->fetch_assoc()) {
            $forums[] = $item;
        }
        /* free result set */
        $result->close();
    }

    # Query last qustions asked and store them
    $lastAskedQuery = "SELECT CF.forumID, questionID, title, details, asked, author FROM classforum CF LEFT JOIN question Q1 ON CF.forumID = Q1.forumID WHERE questionID = (SELECT MAX(Q2.questionID) FROM question Q2 WHERE Q1.forumID = Q2.forumID) GROUP BY CF.forumID";
    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }
    $questions = array();
    if ($result = $connection->query($lastAskedQuery)) {
        while($item = $result->fetch_assoc()) {
            $questions[] = $item;
        }
        /* free result set */
        $result->close();
    }

    # Query number of questions asked and store them
    $qNumQuery = "SELECT forumID, COUNT(questionID) AS \"numQuestions\" FROM question GROUP BY forumID";
    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }
    $questionNum = array();
    if ($result = $connection->query($qNumQuery)) {
        while($item = $result->fetch_assoc()) {
            $questionNum[] = $item;
        }
        /* free result set */
        $result->close();
    }

    # Query number of posts and store them
    $pNumQuery = "SELECT forumID, COUNT(answer.answerID) + COUNT(DISTINCT question.questionID) AS \"numPosts\" FROM question LEFT JOIN answer ON question.questionID = answer.questionID GROUP BY forumID";
    if ($connection->connect_errno) {
        printf("Connect failed: %s\n", $connection->connect_error);
        exit();
    }
    $postNum = array();
    if ($result = $connection->query($pNumQuery)) {
        while($item = $result->fetch_assoc()) {
            $postNum[] = $item;
        }
        /* free result set */
        $result->close();
    }

    # Populate table
    for ($x = 0; $x < count($forums); $x++) {
        $forumID = $forums[$x]['forumID'];
        $className = $forums[$x]['className'];
        $qTitle = $questions[$x]['title'];
        $author = $questions[$x]['author'];
        $asked = $questions[$x]['asked'];
        $numOfQ = $questionNum[$x]['numQuestions'];
        $numOfP = $postNum[$x]['numPosts'];
        echo("<tr id=\"".$forumID."\">");
        echo("<td><h3 class=\"h5\"><a class=\"class_anchor\" href=\"#0\">".$className."</a></h3></td>");
        echo("<td><div><h4 class=\"h6\">".$qTitle."</h4>".$author." -- ".$asked."</div></td>");
        echo("<td><div>".$numOfQ."</div></td>");
        echo("<td><div>".$numOfP."</div></td>");
        echo("</tr>");
    }

    CloseCon($connection);
    ?>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="../js/load-specific-forum.js"></script>
</tbody>
</table>
