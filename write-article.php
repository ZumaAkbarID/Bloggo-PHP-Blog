<?php
session_start();
if(!isset($_SESSION['level']))
{
    header("Location: index.php");
}
include 'database.php';
if(isset($_POST['write']))
{
    $name = $_SESSION['name'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $content1 = $_POST['content1'];
    $content2 = @$_POST['content2'];
    $content3 = @$_POST['content3'];
    $date = date("d-m-Y");

    $check = mysqli_query($connect, "SELECT * FROM article WHERE title='$title'");
    $check2 = mysqli_num_rows($check);
    if($check2>0)
    {
        echo "<script>alert('Title arledy used!')</script>";
    }else{
        $check3 = mysqli_query($connect, "SELECT * FROM article_details WHERE title='$title'");
        $check4 = mysqli_num_rows($check3);
        if($check4>0)
        {
            echo "<script>alert('Title arledy used!')</script>";
        }else{
            $save1 = mysqli_query($connect, "INSERT INTO article(name,title,subtitle,date,newDate,status) VALUE('$name','$title','$subtitle','$date','','unpublished')");
            $save2 = mysqli_query($connect, "INSERT INTO article_details(title,content1,content2,content3) VALUE('$title','$content1','$content2','$content3')");
            if($save1)
            {
                if($save2)
                {
                    echo "<script>alert('Save success, you can publish in Article Manager')</script>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Write Article | Bloggo</title>

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
            <h1>Write Article</h1>
            <span class="subheading">write what you think</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1>Write Article - <b>BLOGGO</b></h1>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" method="post" action="" novalidate>
            <input type="hidden" value="<?= $_SESSION['name'] ?>">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Title</label>
              <input type="text" maxlength="25" class="form-control" placeholder="Title" name="title" id="username" required data-validation-required-message="Please enter a title.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Subtitle</label>
              <input type="text" maxlength="25" class="form-control" placeholder="Subtitle" name="subtitle" id="username" required data-validation-required-message="Please enter a subtitle.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Content field 1</label>
              <textarea rows="3" type="text" maxlength="255" class="form-control" placeholder="Content" name="content1" id="content" required data-validation-required-message="Please enter a content."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Content field 2</label>
              <textarea rows="3" type="text" maxlength="255" class="form-control" placeholder="Content" name="content2" id="content" data-validation-required-message="Please enter a content."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Content field 3</label>
              <textarea rows="3" type="text" maxlength="255" class="form-control" placeholder="Content" name="content3" id="content" data-validation-required-message="Please enter a content."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" name="write" class="btn btn-primary" id="sendMessageButton">Save</button>
          <?php 
            if($save1)
            {
                echo "Save success, you can publish in <a href='manage-article.php'>Article Manager</a>";
            }
          ?>
        </form>
      </div>
    </div>
  </div>

  <hr>

  <?php include 'include/footer.php' ?>

</body>

</html>