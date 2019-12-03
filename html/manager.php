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
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'MANAGER') {
  header('HTTP/1.0 403 Forbidden');
  die('Access denied');
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="../css/dark-mode.css">
    <link rel="stylesheet" type="text/css" href="../css/manager.css">
    <!-- ///Title Pending/// -->
    <title>TA Manager</title>

  </head>
  <body>
    <!--Webpage body -->
    <div class="container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <h1>Manager Tools</h1>
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
                  <a role="forum button" type="button" class="btn btn-primary" href="forum.php">Forum</a>
                  <a href="manager.php" role="manager button" type="button" class="btn btn-primary">Manager Functions</a>
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

      <!-- Toggle all tabs button -->
      <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="collapseOne collapseTwo collapseThree collapseFour">Toggle all tabs</button>

      <!-- collapsable sections -->
      <div class="accordion" id="collapsibleTab">
            <!-- Add people tab -->
            <div class="card">
              <div class="tabButton" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-outline-primary collapsed btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Add People
                  </button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse multi-collapse" aria-labelledby="headingOne">
                <div class="card-body">
                  <form method="post" action="../php/add_people.php">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                    </div>
                    <div class="form-group">
                      <label for="emailInput">Email</label>
                      <input type="email" class="form-control" id="emailInput" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                      <label for="courseInput">Course</label>
                      <input type="text" class="form-control" id="courseInput" placeholder="Course" name="course">
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="TA">
                      <label class="form-check-label" for="exampleRadios1">
                        TA
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="MANAGER">
                      <label class="form-check-label" for="exampleRadios2">
                        Manager
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">add</button>
                  </form>
                </div>
              </div>
            </div>

            <!-- Remove people tab -->
            <div class="card">
              <div class="tabButton" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-outline-primary collapsed btn-block" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Remove People
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse multi-collapse" aria-labelledby="headingTwo">
                <div class="card-body">
                  <form>
                    <div class="form-group">
                      <label for="emailInput">Email of person to remove</label>
                      <input type="email" class="form-control" id="emailInput" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="passInput">Confirm your password</label>
                      <input type="password" class="form-control" id="passInput" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">remove</button>
                  </form>
                </div>
              </div>
            </div>

            <!-- Scheduling tab -->
            <div class="card">
              <div class="tabButton" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-outline-primary collapsed btn-block" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Scheduling
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse multi-collapse" aria-labelledby="headingThree">
                <div class="card-body">
                 <!-- Tab links -->
                <div class="tab">
                  <button class="tablinks" onclick="openTab(event, 'Semester')">Manage Semester</button>
                  <button class="tablinks" onclick="openTab(event, 'Shift')">Add Shifts</button>
                  <button class="tablinks" onclick="openTab(event, 'Cover')">Approve Covers</button>
                  <button class="tablinks" onclick="openTab(event, 'Management')">Student Management</button>
                </div>
                  <!-- Tab content -->
                <div id="Semester" class="tabcontent">
                  <h3>Manage Semester</h3>
                  <form action="../php/add_semester.php" method="get">
                    <div class="form-group">
                      <label for="sem_start">Start</label>
                      <input name="start" id="sem_start" type="date">
                    </div>
                    <div class="form-group">
                      <label for="sem_end">End</label>
                      <input name="end" id="sem_end" type="date">
                    </div>
                    <input type="submit" value="Submit">
                  </form>
                </div>
                <div id="Shift" class="tabcontent">
                  <h3>Add Shifts</h3>
                    <form action="/php/add_shift.php" method="get">
                      <div class="form-group">
                        <label for="addshift-semester">Semester</label>
                        <select name="semester" id="addshift-semester" required>
<?php
require_once('../php/db_connection.php');
$conn = OpenCon();
$stmt = $conn->prepare('SELECT semesterID, start, end FROM semester');
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
  $start = str_replace('-', '/', explode(' ', $row['start'])[0]);
  $end = str_replace('-', '/', explode(' ', $row['end'])[0]);
  echo '<option value="' . $row['semesterID'] . '">' . $start . ' - ' . $end . '</option>';
}
$result->close();
$stmt->close();
$conn->close();
?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="addshift-date">Date</label>
                        <input type="date" name="date" id="addshift-date" required>
                      </div>
                      <div class="form-group">
                        <label for="addshift-start">Start time</label>
                        <input type="time" name="start" id="addshift-start" required>
                      </div>
                      <div class="form-group">
                        <label for="addshift-end">End time</label>
                        <input type="time" name="end" id="addshift-end" required>
                      </div>
                      <div class="form-group">
                        <input type="checkbox" name="repeats" id="addshift-repeats" checked>
                        <label for="addshift-repeats">Repeats weekly</label>
                      </div>
                      <div class="form-group">
                        <label for="addshift-ta">TA</label>
                        <select name="ta" id="addshift-ta" required>
<?php
require_once('../php/db_connection.php');
$conn = OpenCon();
$stmt = $conn->prepare('SELECT personID, name FROM person WHERE role = \'TA\'');
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
  echo '<option value="' . $row['personID'] . '">' . $row['name'] . '</option>';
}
$result->close();
$stmt->close();
$conn->close();
?>
                        </select>
                      </div>
                      <input type="submit" value="Create shift">
                    </form>
                </div>
                <div id="Cover" class="tabcontent">
                  <h3>Approve Covers</h3>
                  <p>This is the tab for the Approve Covers functions</p>
                </div>

                <div id="Management" class="tabcontent">
                  <h3>Student Management</h3>
                  <p>This is the tab for the Student Management functions</p>
                </div>
                </div>
               </div>
            </div>

            <!-- Statistics tab -->
            <div class="card">
                <div class="tabButton" id="headingFour">
                  <h2 class="mb-0">
                    <button class="btn btn-outline-primary collapsed btn-block" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Statistics
                    </button>
                  </h2>
                </div>
                <div id="collapseFour" class="collapse multi-collapse" aria-labelledby="headingFour">
                  <div class="card-body">
                    Statistics content
                      <div class="wrapper">
                      <div class="panel">
                        <div class="panel-header">
                          <h3 class="title">Statistics</h3>
                          <div class="calendar-views">
                            <span>Day</span>
                            <span>Week</span>
                            <span>Month</span>
                          </div>
                        </div>

                        <div class="panel-body">
                          <div class="categories">
                            <div class="category">
                              <span>New Users</span>
                              <span>1.897</span>
                            </div>
                            <div class="category">
                              <span>Recurring Users</span>
                              <span>127</span>
                            </div>
                            <div class="category">
                              <span>Page Views</span>
                              <span>8.648</span>
                            </div>
                          </div>

                          <div class="chart">
                            <div class="operating-systems">
                              <span class="ios-os">
                                <span></span>Filler
                              </span>
                              <span class="windows-os">
                                <span></span>Filler
                              </span>
                              <span class="android-os">
                                <span></span>Filler
                              </span>
                            </div>

                            <div class="android-stats">
                              filler <span></span>
                            </div>
                            <div class="ios-stats">
                              <span></span>filler
                            </div>
                            <div class="windows-stats">
                              <span></span>filler
                            </div>

                            <svg width="563" height="204" class="data-chart" viewBox="0 0 563 204" xmlns="http://www.w3.org/2000/svg">
                <svg width="563" height="204" class="data-chart" viewBox="0 0 563 204" xmlns="http://www.w3.org/2000/svg">
                      <g fill="none" fill-rule="evenodd">
                        <path class="dataset-1" d="M30.046 97.208c2.895-.84 5.45-2.573 7.305-4.952L71.425 48.52c4.967-6.376 14.218-7.38 20.434-2.217l29.447 34.46c3.846 3.195 9.08 4.15 13.805 2.52l31.014-20.697c4.038-1.392 8.485-.907 12.13 1.32l3.906 2.39c5.03 3.077 11.43 2.753 16.124-.814l8.5-6.458c6.022-4.577 14.563-3.676 19.5 2.056l54.63 55.573c5.622 6.526 15.686 6.647 21.462.258l37.745-31.637c5.217-5.77 14.08-6.32 19.967-1.24l8.955 7.726c5.42 4.675 13.456 4.63 18.82-.11 4.573-4.036 11.198-4.733 16.508-1.735l61.12 34.505c4.88 2.754 10.916 2.408 15.45-.885L563 90.915V204H0v-87.312-12.627c5.62-.717 30.046-6.852 30.046-6.852z" fill="#7DC855" opacity=".9"/>
                        <path class="dataset-2" d="M563 141.622l-21.546-13.87c-3.64-2.343-8.443-1.758-11.408 1.39l-7.565 8.03c-3.813 4.052-10.378 3.688-13.718-.758L469.83 84.58c-3.816-5.08-11.588-4.687-14.867.752l-28.24 46.848c-2.652 4.402-8.48 5.673-12.74 2.78l-15.828-10.76c-3.64-2.475-8.55-1.948-11.575 1.245l-53.21 43.186c-3.148 3.32-8.305 3.74-11.953.974l-100.483-76.2c-3.364-2.55-8.06-2.414-11.27.326l-18.24 15.58c-3.25 2.773-8.015 2.874-11.38.24L159.91 93.79c-3.492-2.733-8.467-2.51-11.697.525l-41.58 39.075c-2.167 2.036-5.21 2.868-8.117 2.218L39.05 112.5c-4.655-1.808-9.95-.292-12.926 3.7L0 137.31V204h563v-62.378z" fill="#F8E71C" opacity=".6"/>
                        <path class="dataset-3" d="M0 155.59v47.415c0 .55.448.995 1 .995h562v-43.105l-40.286 11.83c-3.127.92-6.493.576-9.368-.954l-53.252-28.32c-5.498-2.924-12.323-1.365-15.987 3.654l-25.48 34.902c-4.08 5.59-12.478 5.513-16.455-.148L360.06 121.92c-2.802-4.073-8.2-5.457-12.633-3.237L322.2 133.827c-4.415 2.21-9.792.848-12.604-3.196L282.78 99.25c-4.106-5.906-12.978-5.6-16.665.57l-26.757 44.794c-3.253 5.446-10.753 6.468-15.36 2.092l-16.493-15.673c-4.27-4.058-11.138-3.522-14.72 1.148l-23.167 30.21c-3.722 4.852-10.937 5.207-15.12.744l-44.385-47.345c-5.807-5.427-14.83-5.508-20.734-.19l-55.76 48.31c-3.76 3.26-9.127 3.93-13.582 1.703L0 155.59z" fill="#F5A623" opacity=".7"/>
                        <path class="lines" fill="#FFF" opacity=".2" d="M0 203h563v1H0zM0 153h563v1H0zM0 102h563v1H0zM0 51h563v1H0zM0 0h563v1H0z"/>
                      </g>
                    </svg>
                            </svg>

                          </div>
                        </div>
                      </div>
                      <!-- Geoffrey Wright: Added some forum stats for you. :) -->
                      <!-- Drop into php to query some stats from the database. -->
                      <?php
                        require_once('../php/db_connection.php');
                        $connection = OpenCon();
                        
                        $query = ""; #for querys
                        $result_table = array(); # for processing the result

                        if ($connection->connect_errno) {
                          printf("Connect failed: %s\n", $connection->connect_error);
                          exit();
                        }

                        echo("<br><h4>Forum Breakdown</h4>");
                        echo("<table class=\"table table-striped table-dark\">");
                        echo("<thead>");
                        echo("<tr>");
                        echo("<th scope=\"col\">Statistic</th>");
                        echo("<th scope=\"col\">Result</th>");
                        echo("</tr>");
                        echo("</thead>");
                        echo("<tbody>");
                        echo("<tr>");
                        echo("<th scope=\"row\">Total class forums registered</th>");
                        $query = "SELECT COUNT(forumID) AS total FROM classforum";
                        if ($result = $connection->query($query)) {
                          while($item = $result->fetch_assoc()) {
                            $result_table[] = $item;
                          }
                          $result->close();
                        }
                        echo("<td>".$result_table[0]['total']."</td>");
                        echo("</tr>");
                        echo("<tr>");
                        echo("<th scope=\"row\">Total questions asked</th>");
                        $query = "SELECT COUNT(questionID) AS total FROM question";
                        $result_table = array(); #reset array
                        if ($result = $connection->query($query)) {
                          while($item = $result->fetch_assoc()) {
                            $result_table[] = $item;
                          }
                          $result->close();
                        }
                        echo("<td>".$result_table[0]['total']."</td>");
                        echo("</tr>");
                        echo("<tr>");
                        echo("<th scope=\"row\">Total answers given</th>");
                        $query = "SELECT COUNT(answerID) AS total FROM answer";
                        $result_table = array(); #reset array
                        if ($result = $connection->query($query)) {
                          while($item = $result->fetch_assoc()) {
                            $result_table[] = $item;
                          }
                          $result->close();
                        }
                        echo("<td>".$result_table[0]['total']."</td>");
                        echo("</tr>");
                        echo("<tr>");
                        echo("<th scope=\"row\">Most recently asked question</th>");
                        $query = "SELECT className, title, asked, author FROM classforum RIGHT JOIN question ON classforum.forumID = question.forumID ORDER BY question.asked DESC LIMIT 1";
                        $result_table = array(); #reset array
                        if ($result = $connection->query($query)) {
                          while($item = $result->fetch_assoc()) {
                            $result_table[] = $item;
                          }
                          $result->close();
                        }
                        echo("<td>Class: ".$result_table[0]['className']."<span style=\"padding-left:2em\">Title: ".$result_table[0]['title']."</span><span style=\"padding-left:2em\">Asked: ".$result_table[0]['asked']."</span><span style=\"padding-left:2em\">Author: ".$result_table[0]['author']."</span></td>");
                        echo("</tr>");
                        echo("</tbody>");
                        echo("</table>");

                        echo("<h4>Questions that have yet to be answered</h4>");
                        echo("<table class=\"table table-striped table-dark\">");
                        echo("<tbody>");
                        $query = "SELECT a.className, b.title, b.asked, b.qauthor FROM classforum a RIGHT JOIN (SELECT q.questionID, q.forumID, q.title, q.asked,q.author as qauthor, an.answer FROM question q LEFT JOIN answer an ON q.questionID = an.questionID WHERE an.answer IS NULL) b ON a.forumID = b.forumID ORDER BY a.className";
                        $result_table = array(); #reset array
                        if ($result = $connection->query($query)) {
                          while($item = $result->fetch_assoc()) {
                            $result_table[] = $item;
                          }
                          $result->close();
                        }
                        for ($i = 0; $i < count($result_table); $i++) {
                          echo("<tr><td>"."Class: ".$result_table[$i]['className']." <span style=\"padding-left:2em\">Title: ".$result_table[$i]['title']."</span><span style=\"padding-left:2em\">Asked: ".$result_table[$i]['asked']."</span><span style=\"padding-left:2em\">Author: ".$result_table[$i]['qauthor']."</span></td></tr>");
                        }
                        echo("</tbody>");
                        echo("</table>");

                        CloseCon($connection);
                      ?>
                  </div>
                </div>
              </div>
          </div>

      <!-- Login Modal -->
      <div class="modal fade" id="loginModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1>Login</h1>
            </div>
            <div class="modal-body">
              <form>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              <button class="btn btn-default" value="Close" data-dismiss="modal">Close</button>
            </div>
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

    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/dark-mode-switch.js"></script>
    <script src="../js/manager.js"></script>
  </body>
</html>
