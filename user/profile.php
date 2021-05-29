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
                            <b><?php echo $_SESSION["name"]?>     
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
                            <b><?php echo $profile["username"]?> 
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
                            <b><?php echo $profile["nik"]?> 
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
                            <b><?php echo $profile["email"]?>  
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
                            <b><?php if ($profile["no_rekening"] == 0){
                                echo "-";
                            }?>  
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='../user/edit_profile.php'" style="width:100px;">Edit</button><br>
                        </td>
                    </tr>                     
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>                                        
    </div><!-- Main Col END -->
</div><!-- body-row END --> 

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