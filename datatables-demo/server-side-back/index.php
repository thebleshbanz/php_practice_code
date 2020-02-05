<html>
	<head>
		<title>Datatables</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" >
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="style.css">	
		<style>
			body {font-family: calibri;color:#4e7480;}
		</style>
	</head>

<body>
<div class="container" style="margin:5px 5px;" >
	<div class="col-sm-4">
		<div id="" class="">
			<label>
				<input type="radio" name="usertype" class="usertype" value="1">Buyer
				<input type="radio" name="usertype" class="usertype" value="2">Seller
			</label>
		</div>
	</div>
	<div class='col-sm-4'>
		<div class="form-group">
			<div class='input-group date' id='datetimepicker1'>
				<input type='text' name="datetimepicker"  class="form-control " id="datetimepicker" />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>	

	<div class="col-sm-4">
		<select data-column="2" name="select_education" multiple="multiple" size="4" class="select_education">
			<option value="">(Select education)</option>
			<option value="1">10th</option>
			<option value="2">12th</option>
			<option value="3">UG</option>
			<option value="4">PG</option>
		</select>
	</div>
	<table id="user-detail" class="display nowrap" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Fullname</th>
				<th>mobile</th>
				<th>education</th>
				<th>email</th>
				<!-- <th>password</th> -->
				<th>user_type</th>
				<th>address</th>
				<th>city</th>
				<th>pincode</th>
				<th>DATE</th>
			</tr>
		</thead>

		<body>
			
		</body>
	</table>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.27/moment.min.js"></script> 
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  
<script>
$(document).ready(function() {
   var table = $('#user-detail').dataTable({
		//"scrollX": 450,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
		"ordering": true,
        "searching": true,
		"order": [[ 1, "asc" ]],
		"ajax": 
		{
			"url": "server.php",
			"data": function (d) 
						{
							d.userType = $("input[name='usertype']:checked").val();
							d.userEducation = $('.select_education').val();
							d.userTimepicker = $('#datetimepicker').val();
						}															
		},	
		"columns": [
				{"name": "id", "Orderdata": "id" },
				{"name": "fullname", "Orderdata": "fullname" },
				{"name": "mobile", "Orderdata": "mobile" },
				{"name": "education", "Orderdata": "education" },
				{"name": "email", "Orderdata": "email" },
				{"name": "user_type", "Orderdata": "user_type" },
				{"name": "address", "Orderdata": "address" },
				{"name": "city", "Orderdata": "city" },
				{"name": "pincode", "Orderdata": "pincode" },
				{"name": "date", "Orderdata": "date" }
			  ]
    } );
	$('.usertype').change(function (e) 
	{
      table.fnDraw();
	});
	$('.select_education').change(function (f) 
	{
      table.fnDraw();
	});	
	
	$(function () 
	{
		$('#datetimepicker1').datetimepicker().on('dp.change', function(e){ 
			table.fnDraw();
		}); 
	});	
} );
</script>
</html>