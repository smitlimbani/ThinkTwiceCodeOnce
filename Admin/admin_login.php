<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
  <style>
  body {
      background:#333;
  }

  </style>
  <script>
  function show_toast() {
      var x = document.getElementById("snackbar")
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }
  </script>
</head>
<body>
  <div class="container">
  <div class="row">
      <div class="form_bg">
        <div style="text-align:center"><img class="img-circle" src="csi-logo.png" height="150px" width="150px"></div>
          <form action="admin_login_check.php" method="POST">
               <h1 class="text-center">ADMIN PANEL</h1>
              <br/>
              <div class="form-group">
                  <input type="text" class="form-control" id="username" placeholder="Username" name="username">
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" id="pwd" placeholder="Password" name="password">

                  </div>
                  <br/>
                 <div class="align-center">
              <button type="submit" class="btn btn-primary" id="login">Login</button>
                  </div>
          </form>
      </div>
  </div>
</div>
<div id="snackbar"><?php echo $_GET['msg']; ?></div>
<?php
if(isset($_GET['msg']))
{
  if($_GET['msg']!==null)
  {
  ?>
    <script>
    show_toast();
    </script>
  <?php
  }
}
?>
</body>
</html>
