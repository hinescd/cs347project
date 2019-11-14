<?php
require_once('db_connection.php');
$connection = OpenCon();

# Query classes and store them
$classQuesQuery = "SELECT classforum.forumID, className, questionID, title, details, asked, author FROM classforum JOIN question ON classforum.forumID = question.forumID WHERE classforum.forumID = ".$_POST['class']." ORDER BY questionID DESC";
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $connection->connect_error);
    exit();
}
$questions = array();
if ($result = $connection->query($classQuesQuery)) {
    while($item = $result->fetch_assoc()) {
        $questions[] = $item;
    }
    /* free result set */
    $result->close();
}

echo("<table id=\"class_forum\" class=\"table table-striped table-responsive\">");
echo("<thead class=\"thead-light\">");
echo("<tr>");
echo("<th class=\"col\">Title</th>");
echo("<th class=\"col\">author</th>");
echo("<th class=\"col\">asked</th>");
echo("</tr>");
echo("</thead>");
echo("<tbody>");
for ($x = 0; $x < count($questions); $x++) {
    $qID = $questions[$x]['questionID'];
    $qTitle = $questions[$x]['title'];
    $author = $questions[$x]['author'];
    $asked = $questions[$x]['asked'];
    echo("<tr id=\"".$qID."\">");
    echo("<td><h3 class=\"h5\"><a class=\"question_anchor\" href=\"#0\">".$qTitle."</a></h3></td>");
    echo("<td><div>".$author."</div></td>");
    echo("<td><div>".$asked."</div></td>");
    echo("</tr>");
}
echo("</tbody>");
?>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="../js/question-page.js"></script>