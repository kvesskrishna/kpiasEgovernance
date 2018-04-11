<?php
session_start();
if (isset($_SESSION['user'])) {
  header('Location:home');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

  <title>KPIAS Egovernance | User login </title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <center>
            <img src="images/img.jpg" width="100px" height="100px">
          </center>

          <form method="post" action="signin.php">
            <h1>Login<br>
              <?php
              if(isset($_SESSION['login_message'])){
                ?><small>
                  <span class="text-danger"><?php echo $_SESSION['login_message']?></span>
                </small>
                <?php
                unset($_SESSION['login_message']);
              }

              ?> 

            </h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" name="username" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" name="password" />
            </div>
            <div>
              <button class="btn btn-default submit" type="submit" name="login">Log in</button>
              <a class="reset_pass" href="#">Lost your password?</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">

              <div class="clearfix"></div>
              <br />

              <div>
                <h1> KPIAS Egovernance</h1>
                <p>©2018 All Rights Reserved. KPIAS. Privacy and Terms</p>
              </div>
            </div>
          </form>
        </section>
      </div>


    </div>
  </div>
</body>
</html>
