<?php
  session_start();
  include 'database.php';
  $id = $_GET['id'];
  if(empty($id))
  {
    header("Location: index.php");
  }
  $check = mysqli_query($connect, "SELECT * FROM article WHERE article_id='$id' AND status='published'");
  $check1 = mysqli_num_rows($check);
  if($check1<1)
  {
    header("Location: index.php");
  }
  $post = mysqli_query($connect, "SELECT * FROM article WHERE article_id='$id'");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <?php 
    while($d = mysqli_fetch_array($post)) :
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?= $d['subtitle'] ?>">
  <meta name="author" content="<?= $d['name'] ?>">

  <title><?= $d['title'] ?></title>
  <?php endwhile; ?>

  <?php include 'include/head-post.php' ?>

</head>

<body>

  <?php include 'include/navbar.php' ?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php 
          $post = mysqli_query($connect, "SELECT * FROM article WHERE article_id='$id'");
          while($a = mysqli_fetch_array($post)) : ?>
          <div class="post-heading">
            <h1><?= $a['title'] ?></h1>
            <h2 class="subheading"><?= $a['subtitle'] ?></h2>
            <span class="meta">Posted by
              <?php
                $nm = $a['name'];
                $check2 = mysqli_query($connect, "SELECT * FROM users WHERE name='$nm'");
                while($d = mysqli_fetch_array($check2)) :
              ?>
              <a target="_blank" href="<?= $d['sosmed'] ?>"><?= $a['name'] ?></a>
                <?php endwhile; ?>
              on <?php 
                if(!empty($a['newDate']))
                {
                  echo $a['date']." And Update on ".$a['newDate'];
                }else{
                  echo $a['date'];
                }
               ?></span>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php 
            $post = mysqli_query($connect, "SELECT * FROM article WHERE article_id='$id'");
            while($d = mysqli_fetch_array($post)) :
          ?>
          <h1><?= $d['title'] ?></h1>
          <?php 
            $postDet = mysqli_query($connect, "SELECT * FROM article_details WHERE article_id='$id'");
            while($a = mysqli_fetch_array($postDet)) :
              $c1 = $a['content1'];
              $c2 = $a['content2'];
              $c3 = $a['content3'];
          ?>
          <p><?= $c1 ?></p>

          <p><?= $c2 ?></p>
          
          <p><?= $c3 ?></p>

          <!-- <h2 class="section-heading">The Final Frontier</h2> -->

          <!-- <blockquote class="blockquote">The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.</blockquote> -->

          <!-- <a href="#">
            <img class="img-fluid" src="img/post-sample-image.jpg" alt="">
          </a> -->
          <!-- <span class="caption text-muted">To go places and do things that have never been done before – that’s what living is all about.</span> -->

          <?php
            $nm = $d['name'];
            $check2 = mysqli_query($connect, "SELECT * FROM users WHERE name='$nm'");
            while($c = mysqli_fetch_array($check2)) :
          ?>

          <p>Write by <a href="<?= $c['sosmed'] ?>" target="_blank" rel="noopener noreferrer"><?= $c['name'] ?></a> on 
          <?php 
              if(!empty($d['newDate']))
              {
                echo $d['date']." And Update on ".$d['newDate'];
              }else{
                echo $d['date'];
              }
            ?>
          </p>
            <?php endwhile; ?>
            <?php endwhile; ?>
            <?php endwhile; ?>
        </div>
      </div>
    </div>
  </article>

  <hr>

  <?php include 'include/footer.php' ?>

</body>

</html>
