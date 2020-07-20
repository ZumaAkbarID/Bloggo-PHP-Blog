<?php
session_start();
if(isset($_SESSION['level']))
{
    header("Location: index.php");
}
include 'database.php';
if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = sha1(md5($_POST['password']));
    $check = mysqli_query($connect, "SELECT * FROM users WHERE name='$name' OR username='$username'");
    $check2 = mysqli_num_rows($check);
    if($check2 > 0)
    {
        echo "<script>alert('User failed to added, because the name and username are already in use')</script>";
    }else{
        $insert = mysqli_query($connect, "INSERT INTO users(name,username,password,level) VALUE('$name','$username','$password','member')");
        if($insert)
        {
            echo "<script>alert('User sucess added, you can login')</script>";
        }else{
            echo "<script>alert('User failed to added, please contact admin')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Register | Bloggo</title>

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
            <h1>Register</h1>
            <span class="subheading">Lets make this blog popular.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1>let's join us in <b>BLOGGO</b></h1>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" method="post" action="" novalidate>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input maxlength="10" type="text" class="form-control" placeholder="Name" name="name" id="name" required data-validation-required-message="Please enter your name.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Username</label>
              <input type="text" class="form-control" placeholder="Username" name="username" id="username" required data-validation-required-message="Please enter a username.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" required data-validation-required-message="Please enter a password."></input>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" name="register" class="btn btn-primary" id="sendMessageButton">Register</button>
        </form>
      </div>
    </div>
  </div>

  <hr>

  <?php include 'include/footer.php' ?>

</body>

</html>
