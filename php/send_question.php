<?php
  require_once('db_connection.php');
  $connection = OpenCon();

  if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $connection->connect_error);
    exit();
  }

  // var_dump($_POST);

  if ( !empty($_POST['title']) && !empty($_POST['details'])) {
    $title = $_POST['title'];
    $details = $_POST['details'];
    $author;
    if (empty($_POST['author'])) {
      $author = 'anonymous';
    } else {
      $author = $_POST['author'];
    }
    $forumID = $_POST['forumID'];

    # Add question to database
    $addQuestionQuery = "INSERT INTO question(forumID, title, details, asked, author) VALUES (\"".$forumID."\", \"".$title."\", \"".$details."\", NOW(), \"".$author."\")";
    // var_dump($addQuestionQuery);
    if ($connection->query($addQuestionQuery)) {
      echo("Question asked! Please reload.");
    } else {
      echo("Failed to get your question into the database.");
    }

  } else {
    echo("FAILED TO POST TO SERVER: Need topic and question");
  }
  CloseCon($connection);
?>