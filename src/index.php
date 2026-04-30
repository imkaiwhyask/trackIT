<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>trackIT | Asset Management and Inventory</title>

  <link rel="icon" type="image/png" href="assets/images/icon.png"/>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/bfe0d9d3a0.js" crossorigin="anonymous"></script>

  <!-- Optional custom CSS -->
   <!-- Custom styles for this template-->
     <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">



</head>

<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
  <div class="row w-100 justify-content-center">
    
    <div class="col-11 col-sm-8 col-md-5 col-lg-4">
      
      <div class="login-card text-center">

        <!-- Logo -->
<img src="assets/images/trackit-logo.png" class="img-fluid mb-4 d-block mx-auto logo">

        <!-- PHP Alert -->
        <?php if(isset($_GET['invalid'])) { ?>
          <div class="alert alert-warning">
            Invalid Username/Password!
          </div>
        <?php } ?>

        <!-- Form -->
        <form action="backend/_validate_login.php" method="POST">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-user"></i>
              </span>
            </div>
            <input type="text" class="form-control" name="username" placeholder="Username" required>
          </div>

          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-lock"></i>
              </span>
            </div>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>

          <button type="submit" class="btn btn-primary btn-block">
            LOGIN
          </button>

        </form>

      </div>
    </div>

  </div>

</div>


<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>