<div id='question_page'>
  <?php
  require_once('db_connection.php');
  $connection = OpenCon();
  
  # Query for the question forum
  $questionForumQuery = "SELECT question.questionID, title, details, asked, question.author AS qAuthor, answerID, answer, answered, answer.author FROM question LEFT JOIN answer ON question.questionID = answer.questionID WHERE question.questionID =\"".($_POST['question'])."\"ORDER BY answered DESC";
  if ($connection->connect_errno) {
      printf("Connect failed: %s\n", $connection->connect_error);
      exit();
  }
  $questions = array();
  if ($result = $connection->query($questionForumQuery)) {
      while($item = $result->fetch_assoc()) {
          $questions[] = $item;
      }
      /* free result set */
      $result->close();
  }
  # most recent answers to oldest
    echo("<div id=\"".$_POST['question']."\" class=\"card text-center\">");
    echo("<div class=\"card-header\"><h5 class=\"card-title\">".$questions[0]['title']."</h5></div>");
    echo("<div class=\"card-body\">"); # Start body
    echo("<p class=\"card-text\">".$questions[0]['details']."</p>");
    echo("</div>"); # End body
    echo("<div class=\"card-footer text-muted\">"); # Start footer
    echo("<p>".$questions[0]['asked']." -- ".$questions[0]['qAuthor']."</p>");
    echo("<a role=\"answer button\" type=\"button\" data-toggle=\"modal\" data-target=\"#answerModal\" class=\"btn btn-outline-primary\">Answer Question</a>");
    echo("</div>");

    if (!is_null($questions[0]['answerID'])) {
      for ($x = 0; $x < count($questions); $x++) {
        echo("<div class=\"card text-center\">");
        echo("<div class=\"card-body\">"); # Start body
        echo("<p class=\"card-text\">".$questions[$x]['answer']."</p>");
        echo("</div>"); # End body
        echo("<div class=\"card-footer text-muted\">"); # Start footer
        echo("<p>".$questions[$x]['answered']." -- ".$questions[$x]['author']."</p>");
        echo("</div>"); # End footer
        echo("</div>");
      }
    }
    CloseCon($connection);
  ?>
</div>