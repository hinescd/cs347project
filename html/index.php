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
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="../css/dark-mode.css">

    <!-- ///Title Pending/// -->
    <title>TA Homepage</title>

  </head>
  <body>
    <script>
      isTA = <?php echo isset($_SESSION['role']) && $_SESSION['role'] === 'TA' ? 'true' : 'false'; ?>
    </script>
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
                  <a role="button" class="btn btn-primary" href="#" data-toggle="modal" data-target="#helpModal">Help</a>
                  <a role="button" class="btn btn-primary" href="forum.php">Forum</a>
<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'MANAGER'):?>
                  <a href="manager.php" role="button" class="btn btn-primary">Manager Functions</a>
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
          <a href="#" class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#loginModal">Login</a>
<?php endif; ?>
          <div class="nav-link">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="darkSwitch">
              <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
            </div>
          </div>
        </div>
      </nav>

      <!-- Calendar section -->
      <div class="jumbotron">
        <div id="calendar-container">
          <div id="calendar-header">
            <button class="btn btn-info" id="prevMonth">&lt;</button>
            <span id="calendar-month-year"></span>
            <button class="btn btn-info" id="nextMonth">&gt;</button>
          </div>
          <div id="calendar-dates" class="col-sm-12"></div>
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
                <p>Welcome to the JMU CS TA page! The calendar below shows which TAs will be in lab and when. The forum can be used to ask and answer questions if you feel you don't need in-person help.</p>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'TA'): ?>
                <p>As a TA, you can click on calendar dates you have a shift on and click on the request a cover button by your shift to request for another TA to fill in for you during that shift. If someone else has requested a cover for their shift, you can click a button to sign up to cover their shift. Once a manager approves your cover, you'll be all set to cover the shift.</p>
                <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'MANAGER'): ?>
                <p>As a manager, you can use the manager functions page to organize various aspects of the TA system, such as adding and removing TAs or managers, defining semesters, creating shifts, and approving covers.</p>
                <?php else: ?>
                <p>If you are a TA or a manager and do not have an account set up, speak with a current manager and they will be able to enter your information into the system. Once they set up an account for you, the password you use when logging in for the first time will be set up as your password for all future logins.</p>
                <?php endif ?>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-default" value="Close" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
      </div>
      <!-- Shift Modal -->
      <div class="modal fade" id="shiftModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 id="shiftModal-date"></h1>
            </div>
            <div class="modal-body" id="shiftModal-list"></div>
            <div class="modal-footer">
              <button class="btn btn-default" value="Close" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/calendar.js"></script>
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