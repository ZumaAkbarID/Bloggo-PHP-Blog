<?php
session_start();
if(!isset($_SESSION['level']))
{
    header("Location: index.php");
}
include 'database.php';
if(!isset($_GET['id']))
{
    header("Location: manage-article.php");
}else{
    $name = $_SESSION['name'];
    $article_id = $_GET['id'];
    $check = mysqli_query($connect, "SELECT * FROM article WHERE name='$name' AND article_id='$article_id'");
    $check2 = mysqli_num_rows($check);
    if($check2<1)
    {
        echo "<script>
                var conf = confirm('Are you sure thats your article?, Check Again!');
                if (conf == true)
                {
                    window.location.href = 'manage-article.php';
                }else{
                    window.location.href = 'manage-article.php';
                }
            </script>";
    }
    if(isset($_POST['save']))
    {
        $titles = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $content1 = $_POST['content1'];
        $content2 = @$_POST['content2'];
        $content3 = @$_POST['content3'];
        $newDate = date("d-m-Y");
        $save1 = mysqli_query($connect, "UPDATE article SET title='$titles', subtitle='$subtitle', newDate='$newDate' WHERE article_id='$article_id'");
        $save2 = mysqli_query($connect, "UPDATE article_details SET title='$titles', content1='$content1', content2='$content2', content3='$content3' WHERE article_id='$article_id'");
        if($save1 && $save2)
        {
            echo "<script>alert('Success Edited')</script>";
        }else{
            echo "<script>alert('Failed to Edit')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Edit Article | Bloggo</title>

  <?php include 'include/head.php' ?>

</head>

<body>

    <?php include 'include/navbar.php' ?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Edit Article</h1>
            <span class="subheading">Whats wrong?</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1>Edit Article - <b>BLOGGO</b></h1>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" method="post" action="" novalidate>
        <?php 
            $getVal = mysqli_query($connect, "SELECT * FROM article WHERE name='$name' AND article_id='$article_id'");
            while($d = mysqli_fetch_array($getVal)) :
                $title = $d['title'];
                $getDet = mysqli_query($connect, "SELECT * FROM article_details WHERE title='$title'");
                while($a = mysqli_fetch_array($getDet)) :
        ?>
          <input type="hidden" value="<?= $_SESSION['name'] ?>">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Title</label>
              <input type="text" maxlength="25" class="form-control" placeholder="Title" name="title" id="username" required data-validation-required-message="Please enter a title." value="<?= $d['title'] ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Subtitle</label>
              <input type="text" maxlength="25" class="form-control" placeholder="Subtitle" name="subtitle" id="username" required data-validation-required-message="Please enter a subtitle." value="<?= $d['subtitle'] ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Content field 1</label>
              <textarea rows="3" type="text" maxlength="255" class="form-control" placeholder="Content" name="content1" id="content" required data-validation-required-message="Please enter a content."><?= $a['content1'] ?></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Content field 2</label>
              <textarea rows="3" type="text" maxlength="255" class="form-control" placeholder="Content" name="content2" id="content" data-validation-required-message="Please enter a content."><?= $a['content2'] ?></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Content field 3</label>
              <textarea rows="3" type="text" maxlength="255" class="form-control" placeholder="Content" name="content3" id="content" data-validation-required-message="Please enter a content."><?= $a['content3'] ?></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" name="save" class="btn btn-primary" id="sendMessageButton">Save</button>
          <?php 
            if($save1)
            {
                echo "Save success, you can publish in <a href='manage-article.php'>Article Manager</a>";
            }
        endwhile;
        endwhile;
          ?>
        </form>
      </div>
    </div>
  </div>

  <hr>

  <?php include 'include/footer.php' ?>

</body>

</html>