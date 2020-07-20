<?php
session_start();
if(isset($_SESSION['level']))
{
    header("Location: index.php");
}
include 'database.php';
if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = sha1(md5($_POST['password']));
    $check = mysqli_query($connect, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $check2 = mysqli_num_rows($check);
    if($check2 > 0)
    {
        while($d = mysqli_fetch_array($check))
        {
            $_SESSION['name'] = $d['name'];
            $_SESSION['username'] = $d['username'];
            $_SESSION['level'] = $d['level'];
        }
        header("Location: index.php");
    }else{
        echo "<script>alert('Login Failed, Username or Password Wrong')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Login | Bloggo</title>

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
            <h1>Login</h1>
            <span class="subheading">Don't have an account? make now!</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1>Login - <b>BLOGGO</b></h1>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" method="post" action="" novalidate>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Username</label>
              <input type="text" class="form-control" placeholder="Username" name="username" id="username" required data-validation-required-message="Please enter your username.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" required data-validation-required-message="Please enter your password."></input>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" name="login" class="btn btn-primary" id="sendMessageButton">Login</button>
          <p>Forgot password? contact admin!</p>
        </form>
      </div>
    </div>
  </div>

  <hr>

  <?php include 'include/footer.php' ?>

</body>

</html>
