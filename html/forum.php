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
    <title>TA Forum</title>

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
                  <a role="forum button" type="button" class="btn btn-primary" href="#">Forum</a>
<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'MANAGER'):?>
                  <a href="manager.php" role="manager button" type="button" class="btn btn-primary">Manager Functions</a>
<?php endif?>
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
          <form id="search_form" class="form-inline">
            <input id="search_field" type="text" name="search-string" class="form-control" placeholder="Search">
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
      <!-- Below scrip will launch the search functionality -->
      <script>
      $(document).ready(function () {
        $('#search_form').submit(function (e) {
          e.preventDefault()
          const forumIndex = document.getElementById('forum_index')
          $('#search_index').remove()
          $('#search_results').remove()

          if ($('#question_page').length !== 0) {
            console.log('Inside initial if')
            $('#question_index').remove()
            $('#question_page').remove()
            $('#class_index').remove()
            $('#class_forum').remove()
            $('#forum_breadcrumb_list').append('<li id=\"search_index\" class=\"breadcrumb-item active\">Search Results</li>')
            document.querySelector('#bc_index a').addEventListener('click', function () {
              $('#search_index').remove()
              $('#search_results').remove()
              $('#bc_index a').remove()
              $('#bc_index').html('Index')
              $('#bc_index').addClass('active')
              forumIndex.style.display = 'block'
            })
            $.post('../php/search.php', $(this).serialize(), function (data) {
              $('#forum_container').append(data)
            })
          } else if ($('#class_forum').length !== 0) {
            console.log('Inside if-else')
            $('#class_index').remove()
            $('#class_forum').remove()
            $('#forum_breadcrumb_list').append('<li id=\"search_index\" class=\"breadcrumb-item active\">Search Results</li>')
            document.querySelector('#bc_index a').addEventListener('click', function () {
              $('#search_index').remove()
              $('#search_results').remove()
              $('#bc_index a').remove()
              $('#bc_index').html('Index')
              $('#bc_index').addClass('active')
              forumIndex.style.display = 'block'
            })
            $.post('../php/search.php', $(this).serialize(), function (data) {
              $('#forum_container').append(data)
            })
          } else {
            console.log('Inside else')
            forumIndex.style.display = 'none'
            $('#bc_index').removeClass('active')
            $('#bc_index').empty()
            $('#bc_index').append('<a href="#0">Index</a>')
            $('#forum_breadcrumb_list').append('<li id=\"search_index\" class=\"breadcrumb-item active\">Search Results</li>')
            document.querySelector('#bc_index a').addEventListener('click', function () {
              $('#search_index').remove()
              $('#search_results').remove()
              $('#bc_index a').remove()
              $('#bc_index').html('Index')
              $('#bc_index').addClass('active')
              forumIndex.style.display = 'block'
            })
            $.post('../php/search.php', $(this).serialize(), function (data) {
              $('#forum_container').append(data)
            })
          }
          $('#search_field').val('')
        })
      })
      </script>

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
                <p><h1>Welcome to the TA Help Forum!</h1>
                You are currently on the help forum page.<br>
                The navigation bar at the top is dynamic and changes to a drop-down
                menu if the screen shrinks. Click the triple bars in the top right if
                needed to reveal the navigation menu.<br>
                <h4>The navigation items include:</h4>
                <ul>
                  <li><strong>TA Logo:</strong> Click this to return to the home page.</li>
                  <li><strong>Help:</strong> click this to display this help dialog.</li>
                  <li><strong>Help Forum:</strong> This is where you are, clicking will keep you here.</li>
                  <li><strong>*Hidden* Manager Functions:</strong> available management options for managers.</li>
                  <li><strong>Login:</strong> display login dialog.</li>
                  <li><strong>Dark Mode:</strong> White backgrounds hurt your eyes? Try our Dark Mode!</li>
                </ul>

                <h4>Features of this help forum include:</h4>
                <ul>
                  <li><strong>Search Bar:</strong> You can search available question topics using this. A page of
                  applicable results will be displayed and the breadcrumb updated.</li>
                  <li><strong>Breadcrumb:</strong> This exists underneath the heading section with the search bar.
                   This will update as you navigate the forum, clicking a previous item in the breadcrumb
                   will take to back to that page.</li>
                  <li><strong>Forum and Title items:</strong> In the main forum body there will be "Forum" and "Title"
                   items. These are clickable and will take you to the applicable forum/question page, updating the 
                   breadcrumb.</li>
                  <li><strong>"Ask a Question" button (On a forum page):</strong> Clicking this button displays the
                  modal to ask a question. A question topic and question body are required but an author is not. If
                   no author is provided 'anonymous' will be chosen. *Note* The dialog will not close when
                   you hit submit but a display message will tell you if the process was successful; close and
                   refresh the page to see the changes.</li>
                  <li><strong>"Answer Question" button (On a question page):</strong> Clicking this button displays the
                  modal to answer a question. An answer is required but an author is not. If no author is provided 
                  'anonymous' will be chosen. *Note* The dialog will not close when you hit submit but a display message
                   will tell you if the process was successful; close and refresh the page to see the changes.</li>
                </ul>
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
          alert(text)
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
        const answerFormData = new FormData(this)
        var questionDiv = document.getElementById('question_page').firstElementChild
        var questionID = questionDiv.getAttribute('id')
        answerFormData.append('questionID', questionID)

        fetch ('../php/send_answer.php', {
          method: 'post',
          body: answerFormData,
        }).then(function (response) {
          return response.text()
        }).then(function (text) {
          alert(text)
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