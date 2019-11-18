<!-- This webpaqge has been created through the efforts of Charlie Hines,
Taylour Davis, Rob Verdisco, and Geoffrey Wright for James Madison University's
CS 347 Full-Stack Web Development 0001, FA19, Dr. Stewart.

Special Notes:
This page has been developed with the use of bootstrap. The primary factor in
this decision was adherence to mobile-first development responsiveness.
However, bootstrap also allows for uniformaty of style and standard as well
as recently added ARIA accessability features.-->

<?php
session_start();
require_once('../php/login.php');
if(isset($_POST['action']) && $_POST['action'] === 'login') {
  $login_error = login();
}
if(isset($_POST['action']) && $_POST['action'] === 'logoff') {
  session_unset();
  session_destroy();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Tells internet explorer to use latest rendering engine -->
    <meta http-equiv="X-UA-Compatable" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="../css/dark-mode.css">

    <!-- ///Title Pending/// -->
    <title>TA Help Forum</title>

  </head>
  <body>
    <!--Webpage body -->
    <div class="container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <h1>Welcome to the JMU TA system!</h1>
      </div>

      <!-- Page Navigation Bar-->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php"><img src="../resources/TA_Iconx50px.png" alt="TA Icon"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <div class="btn-group" role="group" aria-label="navigation button group">
                  <a role="help button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#helpModal">Help</a>
                  <a role="forum button" type="button" class="btn btn-primary" href="#">Help Forum</a>
                  <a href="manager.html" role="manager button" type="button" class="btn btn-primary">Manager Functions</a>
              </div>
            </li>
          </ul>
<?php if(isset($_SESSION['personID'])): ?>
          <form method="post" action="index.php">
            <input type="hidden" name="action" value="logoff">
            <input type="submit" class="btn btn-outline-primary my-2 my-sm-0" value="Logoff">
          </form>
<?php else: ?>
          <button class="btn btn-outline-primary my-2 my-sm-0" type="login"><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></button>
<?php endif; ?>
          <div class="nav-link">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="darkSwitch">
              <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
            </div>
          </div>
        </div>
      </nav>

      <!-- Forum section -->
      <div id="forum" class="jumbotron">
        <!-- nav search bar -->
        <nav class="navbar navbar-dark bg-dark">
          <h1><a href="#" class="navbar-brand">Question Forum</a></h1>
          <form class="form-inline">
            <input type="text" class="form-control" placeholder="Search">
            <button type="submit" class="btn btn-primary">Search</button>
          </form>
        </nav>
        <nav aria-label="breadcrumb">
          <ol id="forum_breadcrumb_list" class="breadcrumb">
            <li id="bc_index" class="breadcrumb-item active">Index</li>
          </ol>
        </nav>
        <div id="forum_container">
        <?php require_once('../php/forum_index.php')?>
        </div>
      </div>

      <!-- Login Modal -->
      <div class="modal fade" id="loginModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1>Login</h1>
            </div>
            <form method="post" action="index.php">
              <div class="modal-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                    <input type="hidden" name="action" value="login">
<?php if(!empty($login_error)):?>
                    <span class="badge badge-danger"><?php echo $login_error?></span>
<?php endif;?>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Submit">
                <button class="btn btn-default" value="Close" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Help Modal -->
      <div class="modal fade" id="helpModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <H1>Help</H1>
              </div>
              <div class="modal-body">
                <p>Need help? This nifty help pop-up will eventually contain
                  istructions on how to use the many features of this web app!
                  For now, this content is to be deternined so all that lies here
                  is dust and the hope of a built future. . .
                </p>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-default" value="Close" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
      </div>
    <!-- Ask Modal -->
    <div class="modal fade" id="askModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1>Ask a question!</h1>
          </div>
          <div class="modal-body">
            <form id="ask_form">
              <div class="form-group">
                <label for="question_title">Question Title</label>
                <input type="text" class="form-control" id="question_title" aria-describedby="question title" placeholder="Enter title" name="title">
                <small id="titlehelp" class="form-text text-muted">Please enter the title of your post.</small>
              </div>
              <div class="form-group">
                <textarea id="question_details" rows="4" col="50" name="details" form="ask_form">What's your question?</textarea>
              </div>
              <div class="form-group">
                <label for="question_author">User</label>
                <input type="text" class="form-control" id="question_author" aria-describedby="question author" placeholder="*Optional: Who's asking?" name="author">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Submit" name="submit" form="ask_form">
            <button class="btn btn-default" value="Close" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Below JavaScript is for sending out a ask question submission to the server -->
    <script>
    $(document).ready(function () {
      $('#ask_form').submit(function (e) {
        e.preventDefault()
        const askFormData = new FormData(this)
        var classID = document.querySelector('#class_forum table').getAttribute('id')
        askFormData.append('forumID', classID)

        fetch ('../php/send_question.php', {
          method: 'post',
          body: askFormData,
        }).then(function (response) {
          return response.text()
        }).then(function (text) {
          document.querySelector('#askModal .modal-body').append(text)
        }).catch(function (error) {
          console.log(error)
        })
      })
    })
    </script>
    <!-- Answer Modal -->
    <div class="modal fade" id="answerModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1>What's your answer?</h1>
          </div>
          <div class="modal-body">
            <form id="answer_form">
              <div class="form-group">
                <textarea id="answer" rows="4" col="50" name="answer" form="answer_form">What's your answer?</textarea>
              </div>
              <div class="form-group">
                <label for="answer_author">User</label>
                <input type="text" class="form-control" id="answer_author" aria-describedby="answer author" placeholder="*Optional: Who's answering?" name="author">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" name="submit" value="Submit" form="answer_form">
            <button class="btn btn-default" value="Close" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Below JavaScript is for sending out a answer submission to the server -->
    <script>
    $(document).ready(function () {
      $('#answer_form').submit(function (e) {
        e.preventDefault()
        const askFormData = new FormData(this)
        var questionDiv = document.getElementById('question_page').firstElementChild
        var questionID = questionDiv.getAttribute('id')
        askFormData.append('questionID', questionID)

        fetch ('../php/send_answer.php', {
          method: 'post',
          body: askFormData,
        }).then(function (response) {
          return response.text()
        }).then(function (text) {
          document.querySelector('#answerModal .modal-body').append(text)
        }).catch(function (error) {
          console.log(error)
        })
      })
    })
    </script>
    <script src="../js/dark-mode-switch.js"></script>
<?php if(!empty($login_error)):?>
    <script>
      $(document).ready(function() {
        $('#loginModal').modal('show');
      });
    </script>
<?php endif;?>
  </body>
</html>