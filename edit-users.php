<?php
session_start();
if(!isset($_SESSION['level']))
{
    header("Location: index.php");
}else if($_SESSION['level'] != 'admin')
{
    header("Location: index.php");
}
include 'database.php';
if(!isset($_GET['id']))
{
    header("Location: manage-users.php");
}else{
    $id = $_GET['id'];
    $check = mysqli_query($connect, "SELECT * FROM users WHERE id='$id'");
    $check2 = mysqli_num_rows($check);
    if($check2<1)
    {
        echo "<script>
                var conf = alert('Users not found!');
                if (conf == true)
                {
                    window.location.href = 'manage-users.php';
                }else{
                    window.location.href = 'manage-users.php';
                }
            </script>";
    }
    if(isset($_POST['save']))
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = sha1(md5($_POST['password']));
        $level = $_POST['level'];
        $sosmed = @$_POST['sosmed'];
        $save1 = mysqli_query($connect, "UPDATE users SET name='$name', username='$username', password='$password', level='$level', sosmed='$sosmed' WHERE id='$id'");
        if($save1)
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

  <title>Edit Users | Bloggo</title>

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
            <h1>Edit Users</h1>
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
        <h1>Edit Users - <b>BLOGGO</b></h1>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" method="post" action="" novalidate>
        <?php 
            $getVal = mysqli_query($connect, "SELECT * FROM users WHERE id='$id'");
            while($d = mysqli_fetch_array($getVal)) :
        ?>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" maxlength="25" class="form-control" placeholder="Name" name="name" id="name" required data-validation-required-message="Please enter a name." value="<?= $d['name'] ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Username</label>
              <input type="text" maxlength="25" class="form-control" placeholder="Username" name="username" id="username" required data-validation-required-message="Please enter a username." value="<?= $d['username'] ?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Password</label>
              <input type="text" maxlength="255" class="form-control" placeholder="Password" name="password" id="password" required data-validation-required-message="Please enter a password." value="<?= $d['password'] ?>"></input>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Level</label>
              <input type="text" maxlength="255" class="form-control" placeholder="Level" name="level" id="level" data-validation-required-message="Please enter a level." value="<?= $d['level'] ?>"></input>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Sosmed</label>
              <input type="text" maxlength="255" class="form-control" placeholder="Sosmed" name="sosmed" id="sosmed" data-validation-required-message="Please enter url Sosmed." value="<?= $d['sosmed'] ?>"></input>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" name="save" class="btn btn-primary" id="sendMessageButton">Save</button>
          <?php 
            if($save1)
            {
                echo "Save success!</a>";
            }
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