<!-- pocetak menija -->
<?php @session_start(); ?>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand" ><img class="logo" src="bootstrap/dist/img/logo.png"/></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li >
              <a  href="home.php" id="home">Home</a>
            </li>
            <li>
              <a href="user<?php  //echo $_SESSION['id']; ?>.php">Profile</a>

            </li>
            <li>
              <a href="rank.php">Rank list</a>
            </li>
            
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php" target="_blank">Log Out</a></li>
            
          </ul>
          <!--nesto-->
        </div>
      </div>
    </div>
        <!-- kraj menija menija -->