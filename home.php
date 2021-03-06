<?php @session_start(); ?>
<?php

if (!isset($_SESSION['use'])) {
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UniHelp - Home</title>
    <link rel="icon" href="bootstrap/dist/img/favicon.png"> 
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="bootstrap/dist/css/feed.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,100' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/dist/js/bootstrap.min.js"></script>

    <style>
        .logo {
            height: 55px;
            padding-top: 0px
        }

        #head-text {
            color: white
        }
    </style>


</head>
<body bgcolor="#D3D3D3">
<div class="container">

    <!-- pocetak menija -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <a href="#" class="navbar-brand"><img class="logo" src="bootstrap/dist/img/logo.png"/></a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul class="nav navbar-nav">

                    <li class="dropdown">

                        <ul class="dropdown-menu" aria-labelledby="download">
                            <li><a href="http://jsfiddle.net/bootswatch/jmg3gykg/">Open Sandbox</a></li>
                            <li class="divider"></li>
                            <li><a href="./bootstrap.min.css">bootstrap.min.css</a></li>
                            <li><a href="./bootstrap.css">bootstrap.css</a></li>
                            <li class="divider"></li>
                            <li><a href="./variables.less">variables.less</a></li>
                            <li><a href="./bootswatch.less">bootswatch.less</a></li>
                            <li class="divider"></li>
                            <li><a href="./_variables.scss">_variables.scss</a></li>
                            <li><a href="./_bootswatch.scss">_bootswatch.scss</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </div>
    <!-- kraj menija menija -->

    <?php include("menu.php"); ?>
    <!--wall -->
    <div class="wrap-wall">
        <div class="wall">
            <br>
            <br>
            <br>
            <br>
            <!-- leva strana-->
            <div class="col-md-3" style="padding-top:2%;">
                <header class="tasks-search">

                    <span>Search</span>

                </header>
                <br>

                <form action="home.php" method="post" class="form-horizontal" id="search-forma">
                    <label for="job-type">Job type</label>
                    <select name="job_type" class="form-control" id="job-type">
                        <option>Volunteering</option>
                        <option>Practice</option>
                        <option>Workshop</option>
                        <option>Learning</option>
                        <option>Physical work</option>
                    </select>
                    <br>
                    <label for="peer-type">Location near by</label>
                    <select name="location" class="form-control" id="peer-type">
                        <?php
                        include "connection.php";
                        if (isset($_POST["add_task"])) {
                            include "user.class.php";
                            $user=new User();
                            $u=$user->findUser($_SESSION['id']);

                            include "connection.php";
                            $query5 = "INSERT INTO tasks (description, category, location, parc_number, org_name, reward, exps, expc, expo, partc_id, job_type) VALUES ('" . $mysqli->real_escape_string($_POST['description']) . "', '" . $mysqli->real_escape_string($_POST['category']) . "', '" . $mysqli->real_escape_string($_POST['location']) . "', '" . $_POST['parc_number'] . "', '" . $mysqli->real_escape_string($u) . "', '" . $mysqli->real_escape_string($_POST['reward']) . "', '" . $_POST['exps'] . "', '" . $_POST['expc'] . "', '" . $_POST['expo'] . "', '" . $_SESSION['id'] . "', '" . $mysqli->real_escape_string($_POST['job_type']) . "')";
                            if ($mysqli->query($query5)) {
                                echo "Success";
                            } else {
                                echo "<p>There was an error. Please try again later.</p>" . $mysqli->error;
                            }

                            


                        }

                        $query1 = "SELECT * FROM buildings ";

                        if (!$q1 = $mysqli->query($query1)) {
                            echo "<p>There was an error. Please try again later</p>";
                            exit();
                        }
                        if ($q1->num_rows == 0) {
                            echo "There are no locations in the datebase";
                        } else {
                            while ($row1 = $q1->fetch_object()) {
                                ?>
                                <option><?php echo $row1->buildingname; ?></option>
                            <?php }
                        }
                        $mysqli->close();
                        ?>

                    </select>
                    <br>

                    <button name="choose" type="submit" class="btn btn-default">Submit</button>


                </form>
            </div>
            <!-- kraj leve strane-->
            <!--pocetak wall-a -->
            <div class="col-md-6" style="padding-top:2%;">
                <header>
                    <span class='first'></span>
                    <span>Add task</span>
                  <span><button type="button" class="btn btn-info btn-lg btn-warning" data-toggle="modal"
                                data-target="#myModal" id="myBtn">&#9998;</button>
                      <!-- Modal -->
                      <div class="modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header" id="add-task-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Add task</h4>
                                  </div>
                                  <div class="modal-body">


                                      <form id="add-task-form" method="post" action="home.php">
                                          <textarea name="description" id="add-task-form-description" placeholder="Description" required></textarea>

                                          <div class="form-group">
                                              <label for="add-task-form-num-parc">Number of participants</label>
                                              <input name="parc_number" type="number" class="form-control"
                                                     placeholder="Set number of participants"
                                                     id="add-task-form-num-parc" required>
                                          </div>

                                          <div class="form-group">
                                              <label for="add-task-form-reward">Reward</label>
                                              <input name="reward" type="text" class="form-control"
                                                     placeholder="Enter reward" id="add-task-form-reward">
                                          </div>
                                          <table class="table">
                                              <thead>
                                              <tr>
                                                  <th><label for="add-task-form-job-type">Job type</label></th>
                                                  <th><label for="add-task-form-engagement-type">Engagement type</label></th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                              <tr>
                                                  <td> <select name="job_type" class="form-control" id="add-task-form-job-type">
                                                          <option>Volunteering</option>
                                                          <option>Practice</option>
                                                          <option>Workshop</option>
                                                          <option>Learning</option>
                                                          <option>Physical work</option>
                                                       </select>
                                                  </td>
                                                  <td><select name="category" class="form-control" id="add-task-form-job-type">
                                                          <option>S2S</option>
                                                          <option>C2S</option>
                                                          <option>O2S</option>
                                                          
                                                       </select>
                                                  </td>
                                                  
                                              </tr>

                                              </tbody>
                                          </table>
                                                                                     
                                          <table class="table">
                                              <thead>
                                              <tr>
                                                  <th><label for="add-task-form-exps">Social</label></th>
                                                  <th><label for="add-task-form-expc">Career</label></th>
                                                  <th><label for="add-task-form-exp0">Collaboration</label></th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                              <tr>
                                                  <td><input name="exps" type="number" class="form-control"
                                                             placeholder="Socail XP gained" id="add-task-form-exps"
                                                             required></td>
                                                  <td><input name="expc" type="number" class="form-control"
                                                             placeholder="Carrer XP gained" id="add-task-form-expc"
                                                             required></td>
                                                  <td><input name="expo" type="number" class="form-control"
                                                             placeholder="Collaboration XP gained"
                                                             id="add-task-form-expo" required></td>
                                              </tr>

                                              </tbody>
                                          </table>
                                          <div class="form-group">
                                              <label for="add-task-form-location">Location</label>
                                              <br>
                                              <select name="location" class="selectpicker" id="add-task-form-location">
                                                  <optgroup label="Faculty">
                                                      <?php
                                                      include "building.class.php";
                                                      $b = new Building();
                                                      $b->returnB(4);
                                                      ?>

                                                  </optgroup>
                                                  <optgroup label="Dorm">
                                                      <?php
                                                      $b->returnB(1);
                                                      ?>

                                                  </optgroup>
                                                  <optgroup label="Library">
                                                      <?php
                                                      $b->returnB(3);
                                                      ?>

                                                  </optgroup>
                                                  <optgroup label="Restaurants">
                                                      <?php
                                                      $b->returnB(2);
                                                      ?>

                                                  </optgroup>
                                              </select>


                                          </div>
                                          <div class="modal-footer" id="add-task-form-confirm">
                                              <input name="add_task" type="submit" class="btn btn-default"
                                                     value='add_task'/>
                                          </div>
                                      </form>

                                  </div>

                              </div>

                          </div>
                      </div>
                      <!-- kraj modala-->
                    
                  </span>
                </header>
                <main>
                    <input id='s2s' name='category' type='radio' value='s'>
                    <label for='s2s'>S2S</label>
                    <input id='c2s' name='category' type='radio' value='c'>
                    <label for='c2s'>C2S</label>
                    <input id='o2s' name='category' type='radio' value='o'>
                    <label for='o2s'>O2S</label>
                    <input checked='' id='all' name='category' type='radio' value='all'>
                    <label for='all'>All</label>
                </main>


                <div class='body'>
                    <?php
                    include "connection.php";

                    $query = "SELECT * FROM tasks ";

                    if (isset($_POST['choose'])) {
                        $query .= "WHERE (job_type='" . $_POST['job_type'] . "' AND location='" . $_POST['location'] . "')";
                    }

                    if (!$q = $mysqli->query($query)) {
                        echo "<p>There was an error. Please try again later</p>";
                        exit();
                    }
                    if ($q->num_rows == 0) {
                        echo "There are no tasks in the datebase";
                    } else {
                        while ($row = $q->fetch_object()) {
                            ?>
                            <img alt='kanye' src='http://f.cl.ly/items/1m050C1L382z1c1a1S2E/322005-kanye-west.png'>
                            <div class='t'>
                                <span class='name'><a
                                        href="task.php?id=<?php echo $row->task_id; ?>"><?php echo $row->org_name; ?></a></span>
                                <span class='forward'>&#10150;</span>
                            </div>
                            <div class='b'><?php echo $row->description; ?></div>
                            <hr>
                        <?php }
                    }
                    $mysqli->close();
                    ?>
                </div>
            </div>

            <!-- kraj wall-a-->

            <!-- pocetak desne strane-->
            <div class="col-md-3" style="padding-top:2%;">
                <div class="best-raneked-student">
                    <header class="tasks-search">

                        <span>Best ranked student</span>
                    </header>
                    <div class="panel panel-warning">

                        <div class=panel-body>
                            Jelena Ivkovic<br>
                            Faculty of organizational science<br>
                            320<br>
                        </div>
                    </div>
                </div>

                <div class="best-raneked-faculty">
                    <header class="tasks-search">

                        <span>Best ranked faculty</span>
                    </header>
                    <div class="panel panel-warning">

                        <div class="panel-body">
                            Faculty of organizational science<br>
                            Jove Ilica, 154<br>
                            320<br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- kraj desne strane-->


        </div>

    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            // $('.selectpicker').selectpicker();
        });
    </script>
</body>
</html>