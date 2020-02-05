<?php
include('product_mysql.php');
if(empty($_SESSION['customer_id']))
{
	header("location:index.php");
}elseif($_SESSION['usertype']!=0)
{
	header("location:products_display.php");
}
dbconn();
?>
<html>
<head>
	<title>Dashboard product panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">	
  <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="http://placehold.it/200x50&text=LOGO" alt="LOGO"">
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                </a>
            </li>            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin User <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                    <li><a href="#"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-search"></i> MENU 1 <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-1" class="collapse">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 1.1</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 1.2</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 1.3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-star"></i>  MENU 2 <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 2.1</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 2.2</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 2.3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="product_add.php" class="add-project" data-toggle="modal" data-target="#">Add Product</a>
                </li>
                <li>
                    <a href="product_stock.php" class="add-project" data-toggle="modal" data-target="#">Add Stock</a>
                </li>
                <li>
                    <a href="faq"><i class="fa fa-fw fa fa-question-circle"></i> MENU 5</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                    <h1>Welcome Admin!</h1>
						<h4>Bootstrap Snipp for Datatable</h4>
						<div class="table-responsive">

							<table id="dashboard_table" class="table table-bordred table-striped">
								   
								<thead>
									<th>id</th>
									<th>Product Name</th>
									<th>Description</th>
									<th>Image</th>
									<th>Total Quantity</th>
									<th>Total Sale</th>
									<th>Remaining</th>
									<th>Last Update</th>
									<th>View</th>
									<th>Edit</th>
									<th>Delete</th>
								</thead>
								<tbody>
								<?php //main_dashboard(); ?>								
								</tbody>
							</table>										
						</div>	
				</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script> 
<script src="js/dashboard.js"></script>

<script>
			jQuery(document).ready(function() 
			{
				var dataTable = $('#dashboard_table').dataTable( 
				{
					"processing": true,
					"serverSide": true,
					"paging":   true,
					"searching":true,
					"ordering": true,
					"order": [[ 1, "asc" ]],
					"ajax": "server.php",
					"columns": [
						{"name": "id", "Orderdata": "id" },
						{"name": "name", "Orderdata": "name" },
						{"name": "description", "Orderdata": "description" },
						{"name": "image", "Orderdata": "image" },
						{"name": "quantity", "Orderdata": "quantity" },
						{"name": "purchase", "Orderdata": "purchase" },
						{"name": "remaining", "Orderdata": "remaining" },
						{"name": "date", "Orderdata": "date" },
						{"name": "view", "Orderdata": "view" },
						{"name": "edit", "Orderdata": "edit" },
						{"name": "delete", "Orderdata": "delete" }
					  ]
				} );
			} );
</script>

</html>