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
  /* Link to your background image using in the property below! */
  background: scroll center url('http://wtk.tayo.my.id/assets/logokop.jpg');
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
include "connect_db.php";
?>
<div class="container">
<h1 class="display-4 text-white" align="center" style="padding-top:5%; text-shadow: 5px 5px 5px rgba(0, 0, 0, 0.8);">Selamat Datang di Koperasi Sejahtera Bersama<br> Silahkan Registrasi Untuk Masuk</h1>
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center font-weight-bold">Registrasi</h5>
            <form class="form-signin needs-validation" novalidate action="" method="POST">
              <div class="form-label-group">
                <input type="text" id="name" name="name" class="form-control" placeholder="Nama Lengkap" required autofocus>
                <label for="name">Nama Lengkap</label>
                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
              </div>

              <div class="form-label-group">
                <input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" required autofocus>
                <label for="nik">NIK</label>
                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
              </div>
              
              <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                <label for="email">Email</label>
                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
              </div>

              <div class="form-label-group">
                <input type="text" id="uname" name="uname" class="form-control" placeholder="Username" required autofocus>
                <label for="uname">Username</label>
                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
              </div>
              
              <hr>

              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <label for="password">Password</label>
                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" style="box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">Registrasi</button><br>
              <p align="center">Sudah punya akun? Silahkan <a href="index.php"> Masuk</a></p>
              <?php
              include "connect_db.php";
              if($_SERVER["REQUEST_METHOD"] == "POST"){
                  $nama =$_POST["name"];
                  $nik =$_POST["nik"];
                  $email =$_POST["email"];
                  $username =$_POST["uname"];
                  $password =$_POST["password"];
                  $cek_email = mysqli_query($koneksi,"SELECT * FROM user WHERE email = '$email' OR username = '$username' ");
                  $res_email = mysqli_num_rows($cek_email);
                  $cek_nik = mysqli_query($koneksi,"SELECT * FROM user WHERE nik = '$nik' ");
                  $res_nik = mysqli_num_rows($cek_nik);
                  if ($res_email > 0){
                      echo "email atau username telah digunakan, silakan gunakan email lain";
                  }else if ($res_nik > 0){
                    echo "nik telah digunakan, silakan gunakan nik lain";
                  }else{
                      $sql = mysqli_query($koneksi,"INSERT INTO user(nama_lengkap, nik, email, username, password) VALUES ('$nama','$nik','$email','$username','$password')");
                      if ($sql){
                          echo "Berhasil mendaftar, silakan <a href='index.php'>login</a>";
                      }else {
                          echo "error";
                      }
                  }
              }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
                    
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
