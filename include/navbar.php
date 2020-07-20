  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.php">BLOGGO</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="post.html">Sample Post</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <?php
            if(!isset($_SESSION['level']))
            {
                echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='login.php'>Login</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='register.php'>Register</a>
                    </li>
                ";
            }

            if(isset($_SESSION['level']))
            {
                if($_SESSION['level']=='admin')
                {
                  echo "
                    <li class='nav-item dropdown'>
                      <a class='nav-link dropdown-toggle' id='navbardrop' data-toggle='dropdown' href=''>Manage Blog</a>
                        <div class='dropdown-menu dropdown-menu-right animate'>
                          <a href='manage-users.php' class='dropdown-item'>Manage Users</a>
                          <a href='all-article.php' class='dropdown-item'>Manage Article</a>
                        </div>
                    </li>
                ";
                }
            }
            
            if(isset($_SESSION['level'])){
              echo "
                <li class='nav-item dropdown'>
                  <a class='nav-link dropdown-toggle' id='navbardrop' data-toggle='dropdown' href=''>Article</a>
                  <div class='dropdown-menu dropdown-menu-right animate'>
                    <a href='write-article.php' class='dropdown-item'>Write Article</a>
                    <a href='manage-article.php' class='dropdown-item'>Manage Article</a>
                  </div>
                </li>
                <li class='nav-item dropdown'>
                  <a class='nav-link dropdown-toggle' id='navbardrop' data-toggle='dropdown' href=''>Hi, ".$_SESSION['name']."</a>
                  <div class='dropdown-menu dropdown-menu-right animate'>
                    <a href='profile.php' class='dropdown-item'>Profile</a>
                    <div class='dropdown-divider'></div>
                    <a href='logout.php' class='dropdown-item'>Logout</a>
                  </div>
                </li>
              ";
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>