<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "css.php";
    ?>
  <title>Login Form</title>
  <style>
        :root {
      --input-padding-x: 1.5rem;
      --input-padding-y: .75rem;
    }

    body {
      background: #007bff;
      background: linear-gradient(to right, #0062E6, #33AEFF);
    }

    .card-signin {
      border: 0;
      border-radius: 1rem;
      box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .card-signin .card-title {
      margin-bottom: 2rem;
      font-weight: 300;
      font-size: 1.5rem;
    }

    .card-signin .card-img-left {
      width: 45%;
      background: scroll center url('https://2.bp.blogspot.com/-qXrboYVQ6tk/W2ViaCFHRUI/AAAAAAAAPos/6smdlsmFaIYQ5mJXevIXhW9DalqqV3qfACLcBGAs/s1600/Logo-Koperasi-Indonesia_237-design.jpg');
      background-size: cover;
    }

    .card-signin .card-body {
      padding: 2rem;
    }

    .form-signin {
      width: 100%;
    }

    .form-signin .btn {
      font-size: 80%;
      border-radius: 5rem;
      letter-spacing: .1rem;
      font-weight: bold;
      padding: 1rem;
      transition: all 0.2s;
    }

    .form-label-group {
      position: relative;
      margin-bottom: 1rem;
    }

    .form-label-group input {
      height: auto;
      border-radius: 2rem;
    }

    .form-label-group>input,
    .form-label-group>label {
      padding: var(--input-padding-y) var(--input-padding-x);
    }

    .form-label-group>label {
      position: absolute;
      top: 0;
      left: 0;
      display: block;
      width: 100%;
      margin-bottom: 0;
      /* Override default `<label>` margin */
      line-height: 1.5;
      color: #495057;
      border: 1px solid transparent;
      border-radius: .25rem;
      transition: all .1s ease-in-out;
    }

    .form-label-group input::-webkit-input-placeholder {
      color: transparent;
    }

    .form-label-group input:-ms-input-placeholder {
      color: transparent;
    }

    .form-label-group input::-ms-input-placeholder {
      color: transparent;
    }

    .form-label-group input::-moz-placeholder {
      color: transparent;
    }

    .form-label-group input::placeholder {
      color: transparent;
    }

    .form-label-group input:not(:placeholder-shown) {
      padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
      padding-bottom: calc(var(--input-padding-y) / 3);
    }

    .form-label-group input:not(:placeholder-shown)~label {
      padding-top: calc(var(--input-padding-y) / 3);
      padding-bottom: calc(var(--input-padding-y) / 3);
      font-size: 12px;
      color: #777;
    }
  </style>
</head>
<body>
<?php
session_start();
if(isset($_SESSION["id"])) {
  header("Location:index.php");
}else{
  
}
include "connect_db.php";
?>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center font-weight-bold">Login Form</h5>
            <form action="" method="POST" class="needs-validation" novalidate>
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email" required>
                <label for="inputEmail">Email</label>
                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
              </div>
              <hr>
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                <label for="inputPassword">Password</label>
                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" style="border-radius:5rem; letter-spacing: .1rem; font-weight:bold;">Login</button>
              <hr class="my-4">
              <p align="center">Belum punya akun? Silahkan <a href="register_form.php">Daftar</a></p>
              <?php
              include "connect_db.php";
              if($_SERVER["REQUEST_METHOD"] == "POST"){                  
                  $email =$_POST["email"];
                  $password =$_POST["password"];
                  $cek_login = mysqli_query($koneksi,"SELECT * FROM user WHERE email = '$email' AND password = '$password' ");
                  $cek_login_admin = mysqli_query($koneksi,"SELECT * FROM admin WHERE email_admin = '$email' AND password_admin = '$password' ");
                  if (mysqli_num_rows($cek_login) ==  1){
                      $row = mysqli_fetch_array($cek_login);
                      unset($_SESSION["id_admin"]);
                      session_start();
                      $_SESSION["id"] = $row['id'];
                      $_SESSION["name"] = $row['nama_lengkap'];
                      $_SESSION["email"] = $row['email'];
                      ?>
                      <script type='text/javascript'>
                      document.location = '/user';
                      </script>;<?php
                  }else if (mysqli_num_rows($cek_login_admin) ==  1){
                      $row = mysqli_fetch_array($cek_login_admin);
                      unset($_SESSION["id"]);
                      $_SESSION["id_admin"] = $row['id_admin'];
                      $_SESSION["name"] = $row['nama_admin'];
                      $_SESSION["email"] = $row['email_admin'];
                      ?>
                      <script type='text/javascript'> 
                      document.location = 'admin/index.php';
                      </script>;<?php
                  }else{
                      echo "Username atau password yang anda masukkan salah";
                  }
              }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

</body>
</html>
