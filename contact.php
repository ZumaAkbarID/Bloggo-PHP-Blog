<?php
session_start();
if(isset($_POST['submitE']))
{
  include 'mail/E.php';
}else if(isset($_POST['submitW'])){
    $subject = "Message From Bloggo";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    header("Location: https://api.whatsapp.com/send?phone=6281225389903&text=Hi%2C%20My%20name%20is%20%2A$name%2A.%0AMy%20Email%20is%20%2A$email%2A.%0AMy%20phone%20is%20%2A$phone%2A.%0AI%20have%20message%20for%20you%2C%0A%3A%20%2A$message%2A.%0AThank%20you.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <title>Contact | Bloggo</title>

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
            <h1>Contact Me</h1>
            <span class="subheading">Have questions? I have answers.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" method="post" novalidate>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <?php 
                if(isset($_SESSION['name']))
                {
                  echo "<input type='text' readonly class='form-control' placeholder='Name' name='name' id='name' required data-validation-required-message='Please enter your name.' value=".$_SESSION['name'].">";
                }else{
                  echo "<input type='text' class='form-control' placeholder='Name' name='name' id='name' required data-validation-required-message='Please enter your name.' value=''>";
                }
              ?>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" name="email" id="email" required data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Phone Number</label>
              <input type="number" class="form-control" placeholder="Phone Number" name="phone" id="phone" required data-validation-required-message="Please enter your phone number.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Message</label>
              <textarea rows="5" class="form-control" placeholder="Message" name="message" id="message" required data-validation-required-message="Please enter a message."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="row">
            <div class="col-6">
              <button type="submit" class="btn btn-primary" name="submitE" id="sendMessageButton">Send With Email</button>
            </div>
            <div class="col-6">
              <button type="submit" class="btn btn-primary" name="submitW" id="sendMessageButton">Send With WhatsApp</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <hr>

  <?php include 'include/footer.php' ?>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <!-- <script src="js/contact_me.js"></script> -->


</body>

</html>
