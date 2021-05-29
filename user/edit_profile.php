<!DOCTYPE html>
<html lang="en">
<head>
  <a href="#" class="navbar-brand mx-auto" style="display:flex; justify-content: space-around; border-radius:5px;">
        <img src="https://www.dictio.id/uploads/db3342/original/3X/3/3/330d8a032193a6f42725fac39e0b246a01abd521.jpg" height="100" align="center" alt="Logo-Koperasi">
  </a>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <?php
    include "../css.php";
    ?>
  <title>Koperasi</title>
  <style>
            #body-row {
            margin-left:0;
            margin-right:0;
        }
        #sidebar-container {
            min-height: 100vh;   
            background-color: #333;
            padding: 0;
        }

        /* Sidebar sizes when expanded and expanded */
        .sidebar-expanded {
            width: 230px;
        }
        .sidebar-collapsed {
            width: 60px;
        }

        /* Menu item*/
        #sidebar-container .list-group a {
            height: 50px;
            color: white;
        }

        /* Submenu item*/
        #sidebar-container .list-group .sidebar-submenu a {
            height: 45px;
            padding-left: 30px;
        }
        .sidebar-submenu {
            font-size: 0.9rem;
        }

        /* Separators */
        .sidebar-separator-title {
            background-color: #333;
            height: 35px;
        }
        .sidebar-separator {
            background-color: #333;
            height: 25px;
        }
        .logo-separator {
            background-color: #333;    
            height: 60px;
        }

        /* Closed submenu icon */
        #sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
        content: " \f0d7";
        font-family: FontAwesome;
        display: inline;
        text-align: right;
        padding-left: 10px;
        }
        /* Opened submenu icon */
        #sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
        content: " \f0da";
        font-family: FontAwesome;
        display: inline;
        text-align: right;
        padding-left: 10px;
        }
    </style>
</head>
<body>
<?php
session_start();
include "../connect_db.php";
if(isset($_SESSION["id"])) {
    include "navbar.php";
    $id_user = $_SESSION["id"];
    $role = "User";
    $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE id = $id_user");
    $profile = mysqli_fetch_array( $sql );
}else{
    header("Location:/");
}
?>
    <div class="col p-4">
        <h1 class="display-4" align="center">Profile Pengguna</h1><br>
        <div class="container bootstrap snippets bootdey">
    <div class="panel-body inf-content bg-info text-white"
    style="
    border:1px solid #17A2B8;
    -webkit-border-radius:5px;
    -moz-border-radius:5px;
    border-radius:5px;
    box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
    <div class="row">
        <div class="col-md-4">
            <img alt="" style="width:600px;" title="" class="img-thumbnail rounded" src="../assets/keppin.png"> 
            <ul title="Ratings" class="list-inline ratings text-center">
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
            </ul>
        </div>
        <div class="col-md-7">
            <div class="table-responsive">
            <form class="needs-validation" novalidate action="" method="POST">
            <table class="table table-user-information">
                <tbody>
                    <br>
                    <br>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                ID User                                                
                            </strong>
                        </td>
                        <td class="text-white">
                            <b><?php echo $_SESSION["id"]?>     
                        </td>
                    </tr>
                    <tr>    
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-user  text-primary"></span>    
                                Name                                                
                            </strong>
                        </td>
                        <td class="text-white">
                            <div class="form-label-group">
                                <input type="text" id="name" name="name" value="<?php echo $_SESSION["name"]?>" class="form-control" required autofocus>
                                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
                            </div>  
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                Username                                                
                            </strong>
                        </td>
                        <td class="text-white">
                            <div class="form-label-group">
                                <input type="text" id="username" name="username" value="<?php echo $profile["username"]?>" class="form-control" required autofocus>
                                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
                            </div>
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                NIK                                                
                            </strong>
                        </td>
                        <td class="text-white">
                            <div class="form-label-group">
                                <input type="text" id="nik" name="nik" value="<?php echo $profile["nik"]?>" class="form-control" required autofocus>
                                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
                            </div> 
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-eye-open text-primary"></span> 
                                Role                                                
                            </strong>
                        </td>
                        <td class="text-white">
                            <b><?php echo $role ?>
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-envelope text-primary"></span> 
                                Email                                                
                            </strong>
                        </td>
                        <td class="text-white">
                            <div class="form-label-group">
                                <input type="text" id="email" name="email" value="<?php echo $profile["email"]?>" class="form-control" required autofocus>
                                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
                            </div>  
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-envelope text-primary"></span> 
                                Nomor Rekening                                                
                            </strong>
                        </td>
                        <td class="text-white">
                            <div class="form-label-group">
                                <input type="number" id="norek" name="norek" value="<?php if ($profile["no_rekening"] == 0){
                                
                                }else{
                                    echo $profile["no_rekening"];
                                }?>" class="form-control" required autofocus>
                                <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                        <button type="submit" class="btn btn-lg btn-primary  text-uppercase" style="width:100px;">Save</button>
                        <button type="button" class="btn btn-lg btn-primary text-uppercase" onclick="window.location.href='../user/profile.php'" style="width:100px;">Cancel</button>
                        </td>
                    </tr> 
                    <tr>
                        <td></td>
                        <td>
                        <?php
                            $nomor_rekening = $_POST["norek"];
                            $name1 = $_POST["name"];
                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                $username1 = $profile["username"];
                                $nik1 = $profile["nik"];
                                $email1 = $profile["email"];
                                $view_name = $username1; 
                                $update_view = mysqli_query($koneksi,"CREATE VIEW $view_name AS SELECT * FROM user WHERE email != '$email1' OR username != '$username1' ");
                                $res_view = mysqli_num_rows($update_view);
                                if($profile["username"] != $_POST["username"]){
                                    $username1 = $_POST["username"]; 
                                    
                                }else if($profile["nik"] != $_POST["nik"]){
                                    $nik1 = $_POST["nik"];
            
                                }else if($profile["email"] != $_POST["email"]){ 
                                    $email1 = $_POST["email"]; 
                                    
                                }
                                $cek_username = mysqli_query($koneksi,"SELECT * FROM $view_name WHERE username = '$username1' ");
                                $res_username = mysqli_num_rows($cek_username);
                                if($res_username > 0){
                                    echo "username telah digunakan";
                                }
                                $cek_nik = mysqli_query($koneksi,"SELECT * FROM $view_name WHERE nik = '$nik1' ");
                                $res_nik = mysqli_num_rows($cek_nik);
                                if($res_nik > 0){
                                    echo "NIK telah digunakan";
                                }
                                $cek_email = mysqli_query($koneksi,"SELECT * FROM $view_name WHERE email = '$email1' ");
                                $res_email = mysqli_num_rows($cek_email);
                                if($res_email > 0){
                                    echo "Email telah digunakan";
                                }  
                                
                                if($res_username == 0 && $res_nik == 0 && $res_email == 0){
                                    mysqli_query($koneksi,"UPDATE user SET nama_lengkap = '$name1', nik = '$nik1', email = '$email1' , username = '$username1', no_rekening = '$nomor_rekening'  WHERE id = '$id_user' ");
                                    mysqli_query($koneksi,"DROP VIEW $view_name");
                                    $_SESSION["name"] = $name1;
                                    ?>
                                    <script type='text/javascript'>
                                    alert("berhasil"); 
                                    document.location = '/user/profile.php';
                                    </script>;<?php
                                }
                            }
                            
                        ?>
                        </td>
                    </tr>                    
                </tbody>
            </table>
            </form>
            </div>
        </div>
    </div>
</div>
</div>                                        
    </div><!-- Main Col END -->
</div><!-- body-row END --> 
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
<script>
// Hide submenus
$('#body-row .collapse').collapse('hide'); 

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left'); 

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    
    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}
</script>
</body>
</html>