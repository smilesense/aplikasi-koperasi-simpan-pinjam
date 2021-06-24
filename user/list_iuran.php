<!DOCTYPE html>
<html lang="en">
<head>
  <a href="#" class="navbar-brand mx-auto" style="display:flex; justify-content: space-around; border-radius:5px;">
        <img src="https://www.dictio.id/uploads/db3342/original/3X/3/3/330d8a032193a6f42725fac39e0b246a01abd521.jpg" height="100" align="center" alt="Logo-Koperasi">
  </a>
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
    include "footer.php";
}else{
    header("Location:/");
}
?>
    <div class="col p-4">
    <h1 class="display-4" align="center">Data Iuran Wajib Saya</h1><br>
    <div class="container bg-secondary text-white" style="border-radius:5px; padding:1rem; box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
    	<div class="row" 
        style=
        "    	.row{
		    margin-top:40px;
		    padding: 0 10px;
		}
		.clickable{
		    cursor: pointer;   
		}

		.panel-heading div {
			margin-top: -18px;
			font-size: 15px;
		}
		.panel-heading div span{
			margin-left:5px;
		}
		.panel-body{
			display: none;
		}
        ">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Iuran Wajib Saya</h3>
                        <h3 class="panel-title">Rekening Koperasi : 123456789</h3>
						<div class="pull-right">
							<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
								<i class="glyphicon glyphicon-filter"></i>
							</span>
						</div>
					</div>
					<div class="panel-body">
                    <form id="search" action="" method="POST">
                        <input type="search" name="search" onchange="return cari();" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Cari Data">
                    </form>
                    <script type="text/javascript">
                        $(document).ready(
                            function cari() {
                                document.getElementById["search"].submit();
                            }
                        );
                    </script>
					</div>
                        <div class="table-responsive">
                            <table class="table table-hover text-white" id="dev-table">
                                <thead>
                                    <tr>
                                        <th>Id Iuran</th>
                                        <th>Bulan Iuran</th>
                                        <th>Nominal Iuran</th>
                                        <th>Kode Unik Pembayaran</th>
                                        <th>Status</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $id = $_SESSION["id"];
                                    $search = $_POST["search"];
                                    $sql = mysqli_query($koneksi,"SELECT * FROM data_iuran WHERE id_user = $id AND (nominal like '%".$search."%' OR id_iuran like '%".$search."%' OR status like '%".$search."%') ");
                                    while ( $r = mysqli_fetch_array( $sql ) ) {
                                ?>
                                    <tr>
                                    <td><?php echo $r["id_iuran"];?></td>
                                    <td><?php echo $r["bulan_iuran"];?></td>
                                    <td><?php echo $r["nominal"];?></td>
                                    <td><?php echo $r["kode_unik"];?></td>
                                    <td><?php echo $r["status"];?></td>
                                    <?php 
                                    if($r["status"] == "Belum Dibayar"){?>
                                        <td><a href="/user/bayar_iuran.php?id_iuran=<?php echo $r["id_iuran"];?>" class="btn btn-primary btn-xs"><i class="fas fa-money-bill-wave fa-fw mr-2"></i>Bayar</a></td><?php
                                    }?>
                                    
                                    </tr>
                                <?php
                                }?>
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