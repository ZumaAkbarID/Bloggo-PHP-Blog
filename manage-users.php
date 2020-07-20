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
                        $i = 1;
                        $check = mysqli_query($connect, "SELECT * FROM users ORDER BY id ASC");
                        while($d = mysqli_fetch_array($check)) :
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $d['name'] ?></td>
                        <td><?= $d['username'] ?></td>
                        <td><?= $d['level'] ?></td>
                        <td><?= $d['sosmed'] ?></td>
                        <td>
                            <ul class="mr-1 row">
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
          <!-- <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a> -->
        </div>
      </div>
    </div>
  </div>

  <hr>

  <?php include 'include/footer.php' ?>

</body>

</html>