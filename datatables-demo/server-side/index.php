<html>
	<head>
		<title>Datatables</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="style.css">	
		<style>
			body {font-family: calibri;color:#4e7480;}
		</style>
	</head>

<body>
	<div class="container" style="margin:5px 5px;" >

		<table id="user-detail" class="display nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Customer Name</th>
					<th>Phone</th>
					<th>Address</th>
					<th>City</th>
					<th>Pincode</th>
					<th>Country</th>
					<th>Credit Limit</th>
				</tr>
			</thead>

			<body>
				
			</body>
		</table>
	</div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
  
<script>
$(document).ready(function() {
   var table = $('#user-detail').dataTable({
		//"scrollX": 450,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
		"ordering": true,
        "searching": false,
		"order": [[ 1, "asc" ]],
		"ajax": 
		{
			"url": "server.php",
			"type" : "POST",
			// "dataType":"JSON",
			// "data": {'name':'ashish', 'email':'ashish.van@test.com'},
			success : function(res){
				console.log(res);
			}
		},	
		"columns": [
			{"name": "customerNumber", "Orderdata": "customerNumber" },
			{"name": "customerName", "Orderdata": "customerName" },
			{"name": "phone", "Orderdata": "phone" },
			{"name": "addressLine1", "Orderdata": "addressLine1" },
			{"name": "city", "Orderdata": "city" },
			{"name": "postalCode", "Orderdata": "postalCode" },
			{"name": "country", "Orderdata": "country" },
			{"name": "creditLimit", "Orderdata": "creditLimit" }
		]
    });
});
</script>
</html>