<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		  <h2>Product List</h2>

		  <table class="table">
			<thead>
			  <tr>
				<th>Product Number</th>
				<th>Product Name</th>
				<th>Product Price</th>
				<th>product Quantity</th>
				<th>Action</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td>PRO101</td>
				<td>Honeywell camera</td>
				<td>140$</td>
				<td>5</td>
				<td>
					<form name="paypal_form" method="post" action="payment.php">
						<input type="hidden" name="cmd" value="_xclick" />
						<input type="hidden" name="no_note" value="1" />
						<input type="hidden" name="lc" value="US">
						<input type="hidden" name="currency_code" value="USD" />
						<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
						<input type="hidden" name="pro_id" value="PRO101" />
						<input type="hidden" name="pro_name" value="Honeywell Camera" />
						<input type="hidden" name="pro_price" value="$12" />
						<button type="submit" name="submit"  value="submit" class="btn btn-info">Payment</button>
					</form>				
				</td>
			  </tr>
			</tbody>
		  </table>
		</div>
	</div>
</body>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>