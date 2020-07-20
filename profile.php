<?php
session_start();
if(!isset($_SESSION['level']))
{
    header("Location: index.php");
}
include 'database.php';
$name = $_SESSION['name'];
if(isset($_POST['saveurl']))
{
    $url = $_POST['url'];
    $saveurl = mysqli_query($connect, "UPDATE users SET sosmed='$url' WHERE name='$name'");
    if($saveurl)
    {
        echo "<script>alert('Save Url Success')</script>";
    }else{
        echo "<script>alert('Failed, something wrong, contact admin')</script>";
    }
}
if(isset($_POST['saveusername']))
{
    $username = $_POST['username'];
    $saveusername = mysqli_query($connect, "UPDATE users SET username='$username' WHERE name='$name'");
    if($saveusername)
    {
        echo "<script>
                var conf = alert('Save Username Success, You must log in again to apply');
                if(conf == true)
                {
                    window.location.href = 'logout.php';
                }else{
                    window.location.href = 'logout.php';
                }
            </script>";
    }else{
        echo "<script>
                var conf = alert('Failed, Something wrong, Contact admin');
            </script>";
    }
}
if(isset($_POST['savepassword']))
{
    $oldpw = sha1(md5($_POST['OldPassword']));
    $newpw = sha1(md5($_POST['NewPassword']));
    $checkpw = mysqli_query($connect, "SELECT * FROM users WHERE name='$name' AND password='$oldpw'");
    $check1 = mysqli_num_rows($checkpw);
    if($check1<1)
    {
        echo "<script>alert('Old Password Wrong')</script>";
    }else{
        $savepassword = mysqli_query($connect, "UPDATE users SET password='$newpw' WHERE name='$name'");
        if($savepassword)
        {
        echo "<script>
                var conf = alert('Save Password Success, You must log in again to apply');
                    if(conf == true)
                    {
                        window.location.href = 'logout.php';
                    }else{
                        window.location.href = 'logout.php';
                    }
                </script>";
        }else{
            echo "<script>
                    var conf = alert('Failed, Something wrong, Contact admin');
                </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Profile | Bloggo</title>

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
            <h1>Profile </h1>
            <span class="subheading">Hi, <?= $_SESSION['name'] ?>!</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1>Your Profile - <b>BLOGGO</b></h1>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" method="post" action="" novalidate>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Username</label>
              <input type="text" class="form-control" placeholder="Username" name="username" id="username" required data-validation-required-message="Please enter your username." value="<?= $_SESSION['username'] ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <button type="submit" name="saveusername" class="btn btn-primary" id="sendMessageButton">Save Username</button>
        </form>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" readonly class="form-control" placeholder="Name" name="" id="name" required data-validation-required-message="Please enter your name." value="<?= $_SESSION['name'] ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <form name="sentMessage" id="contactForm" method="post" action="" novalidate>
          <div class="control-group row">
            <div class="form-group col-6 floating-label-form-group controls">
              <label>Old Password</label>
              <input type="password" class="form-control" placeholder="OldPassword" name="OldPassword" id="OldPassword" required data-validation-required-message="Please enter your Old Password.">
              <p class="help-block text-danger"></p>
            </div>
            <div class="form-group col-6 floating-label-form-group controls">
              <label>New Password</label>
              <input type="password" class="form-control" placeholder="New Password" name="NewPassword" id="NewPassword" required data-validation-required-message="Please enter your NewPassword.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <button type="submit" name="savepassword" class="btn btn-primary" id="sendMessageButton">Save Password</button>
        </form>

          <form name="sentMessage" id="contactForm" method="post" action="" novalidate>
          <?php 
            $user = mysqli_query($connect, "SELECT * FROM users WHERE name='$name'");
            while($d = mysqli_fetch_array($user)) :
          ?>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Social Media Url <span>(can change)</span></label>
              <input type="text" class="form-control" placeholder="Url (can change)" name="url" id="url" required data-validation-required-message="Please enter your Social Media Url." value="<?= $d['sosmed'] ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
            <?php endwhile; ?>
          <br>
          <div id="success"></div>
          <button type="submit" name="saveurl" class="btn btn-primary" id="sendMessageButton">Save URL</button>
        </form>
      </div>
    </div>
  </div>

  <hr>

  <?php include 'include/footer.php' ?>

</body>

</html>
