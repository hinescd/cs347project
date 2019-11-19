<div id="search_results">
  <?php
  require_once('db_connection.php');
  $connection = OpenCon();
  if(isset($_POST['search-string'])) {
    if(strlen($_POST['search-string']) === 0) {
      echo("<span class=\"badge badge-danger\">A search cannot be performed on an empty string, please enter a value.</span>");
    } else { 
      # Query classes and store them
      $searchQuery = "SELECT classforum.forumID, className, questionID, title, asked, author FROM classforum RIGHT JOIN question ON classforum.forumID = question.forumID WHERE title LIKE \"".$_POST['search-string']."%\"";
      if ($connection->connect_errno) {
          printf("Connect failed: %s\n", $connection->connect_error);
          exit();
      }

      $search = array();
      if ($result = $connection->query($searchQuery)) {
          while($item = $result->fetch_assoc()) {
            $search[] = $item;
          }
          /* free result set */
          $result->close();
      }
      echo("<table id=\"search_table\" class=\"table table-striped table-responsive\">");
      echo("<thead class=\"thead-light\">");
      echo("<tr>");
      echo("<th class=\"col\">Title</th>");
      echo("<th class=\"col\">author</th>");
      echo("<th class=\"col\">asked</th>");
      echo("</tr>");
      echo("</thead>");
      echo("<tbody>");
      if (count($search) > 0) {
        for ($x = 0; $x < count($search); $x++) {
          $fID = $search[$x]['forumID'];
          $className = $search[$x]['className'];
          $qID = $search[$x]['questionID'];
          $qTitle = $search[$x]['title'];
          $author = $search[$x]['author'];
          $asked = $search[$x]['asked'];
          echo("<tr id=\"".$fID."\" class=\"".$className."\">");
          echo("<td><h3 class=\"h5\"><a id=\"".$qID."\" class=\"search_anchor\" href=\"#0\">".$qTitle."</a></h3></td>");
          echo("<td><div>".$author."</div></td>");
          echo("<td><div>".$asked."</div></td>");
          echo("</tr>");
        }
      } else {
        echo("<span class=\"badge badge-danger\">No results could be found.</span>");
      }
      echo("</tbody>");
    }
  } else {
    echo("<span class=\"badge badge-danger\">I Don't know how you got here but something is very wrong.</span>");
    echo("<p>".var_dump($_POST)."</p>");
  }
  CloseCon($connection);
  ?>
  <script src="../js/load-search-result.js"></script>
</div>