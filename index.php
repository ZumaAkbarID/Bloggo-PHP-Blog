<?php 
session_start();
include 'database.php';
$name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <title>BLOGGO</title>

  <?php include 'include/head.php' ?>

</head>

<body>

  <?php include 'include/navbar.php' ?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Clean Blog</h1>
            <span class="subheading">A Blog Theme by Start Bootstrap</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        
          <?php
            $DataOnePage = 5;
            $check3 = $check = mysqli_query($connect, "SELECT * FROM article WHERE status='published'");
            $AllData = mysqli_num_rows($check3);
            $AllPage = ceil($AllData / $DataOnePage);
            if(isset($_GET['page']))
            {
              $activePage = $_GET['page'];
            }else{
              $activePage = 1;
            }
            $FirstData = ($DataOnePage * $activePage) - $DataOnePage;
            $check = mysqli_query($connect, "SELECT * FROM article WHERE status='published' LIMIT $FirstData, $DataOnePage");
            while($d = mysqli_fetch_array($check)) :
          ?>
          <div class="post-preview">
          <a href="post.php?id=<?= $d['article_id'] ?>">
            <h2 class="post-title">
              <?= $d['title'] ?>
            </h2>
            <h3 class="post-subtitle">
            <?= $d['subtitle'] ?>
            </h3>
          </a>
          <p class="post-meta">Posted by
            <?php
              $nm = $d['name'];
              $check2 = mysqli_query($connect, "SELECT * FROM users WHERE name='$nm'");
              while($a = mysqli_fetch_array($check2)) :
            ?>
            <a target="_blank" href="<?= $a['sosmed'] ?>"><?= $d['name'] ?></a>
              <?php endwhile; ?>
            on <?php 
                if(!empty($d['newDate']))
                {
                  echo $d['date']." And Update on ".$d['newDate'];
                }else{
                  echo $d['date'];
                }
               ?></p>
        </div>
        <hr>
            <?php endwhile; ?>
        <!-- Pager -->
        <div class="clearfix">
          <ul class="pagination justify-content-center">
          <?php if($activePage > 1) : ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $activePage - 1; ?>">Previous</a></li>
          <?php else : ?>
            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
          <?php endif; ?>

          <?php for($i = 1; $i <= $AllPage; $i++) : ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i ?></a></li>
          <?php endfor; ?>
            
          <?php if($activePage < $AllPage) : ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $activePage + 1; ?>">Next</a></li>
          <?php else : ?>
            <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
          <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <?php include 'include/footer.php' ?>

</body>

</html>
