<?php 
session_start();
include 'database.php';
if(!isset($_SESSION['level']))
{
    header("Location: index.php");
}else if($_SESSION['level'] != 'admin')
{
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <title>Users Manager | Bloggo</title>

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
        <table class="table table-lg table-bordered table-hover table-striped">
            <thead>
                <?php
                    $name = $_SESSION['name'];
                    $pers = mysqli_query($connect, "SELECT * FROM users");
                    $persCount = mysqli_num_rows($pers);
                    $all = mysqli_query($connect, "SELECT * FROM users");
                    $allCount = mysqli_num_rows($all);
                ?>
                <caption><?= $persCount ?> Found in <?= $allCount ?> Data</caption>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Sosmed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        $DataOnePage = 5;
                        $check3 = $check = mysqli_query($connect, "SELECT * FROM users");
                        $AllData = mysqli_num_rows($check3);
                        $AllPage = ceil($AllData / $DataOnePage);
                        if(isset($_GET['page']))
                        {
                          $activePage = $_GET['page'];
                        }else{
                          $activePage = 1;
                        }
                        $FirstData = ($DataOnePage * $activePage) - $DataOnePage;
                        $i = 1;
                        $check = mysqli_query($connect, "SELECT * FROM users ORDER BY id ASC LIMIT $FirstData, $DataOnePage");
                        while($d = mysqli_fetch_array($check)) :
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $d['name'] ?></td>
                        <td><?= $d['username'] ?></td>
                        <td><?= $d['level'] ?></td>
                        <td><?= $d['sosmed'] ?></td>
                        <td>
                            <ul>
                                <li><a href="edit-users.php?id=<?= $d['id'] ?>" >Edit</a></li>
                                <li><a href="del-users.php?id=<?= $d['id'] ?>">Delete</a></li>
                            </ul>
                        </td>
                    </tr>        
                        <?php $i++; endwhile; ?>
            </tbody>
        </table>
        <hr>
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