<?php
  require_once('db_connection.php');
  $connection = OpenCon();

  if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $connection->connect_error);
    exit();
  }

  // var_dump($_POST);

  if ( !empty($_POST['answer'])) {
    $answer = $_POST['answer'];
    $author;
    if (empty($_POST['author'])) {
      $author = 'anonymous';
    } else {
      $author = $_POST['author'];
    }
    $questionID = $_POST['questionID'];

    # Add question to database
    $addAnswerQuery = "INSERT INTO answer(questionID, answer, answered, author) VALUES (\"".$questionID."\", \"".$answer."\", NOW(), \"".$author."\")";
    // var_dump($addQuestionQuery);
    if ($connection->query($addAnswerQuery)) {
      echo("Answered! Please reload.");
    } else {
      echo("Failed to get your answer into the database.");
    }

  } else {
    echo("FAILED TO POST TO SERVER: Need answer");
  }
  CloseCon($connection);
?>