
<div class="page-container col-12 home checkout">
	<a href="<?=base_url('') ?>">
		<div class="logo text-center col-lg-4 col-6">
			<img class="w-100" src="<?=base_url("assets/img/logo-2.png") ?>">
		</div>
	</a>
	<h3 class="title text-center">Checkout Summary</h3>
	<div class="row">
		<div class="col-lg-7 col-12 content-container left">
			<h5 class="title">Billing Details</h5>
			<div class="content">
				<table class="table">
					<tbody>
						<tr>
							<th scope="row">Bill Reference Number</th>
							<td></td>
							<td>0000000000</td>
						</tr>
						<tr>
							<th scope="row">Bill First Name</th>
							<td></td>
							<td>Tony</td>									
						</tr>
						<tr>
							<th scope="row">Bill Last Name</th>
							<td></td>
							<td>Stark</td>									
						</tr>
						<tr>
							<th scope="row">Bill Amount Due</th>
							<td></td>
							<td>PHP 1000.00</td>									
						</tr>
						<tr>
							<th scope="row">Bill Contact</th>
							<td></td>
							<td>0000-000-0000</td>									
						</tr>
						<tr>
							<th scope="row">Payment Recipient</th>
							<td></td>
							<td>Government</td>									
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-lg-5 col-12 content-container right">
			<h5 class="title">Payment Details</h5>
			<div class="content">
				<table class="table">
					<tbody>
						<tr>
							<th scope="row">Amount to Pay</th>
							<td>PHP 1000.00</td>
						</tr>
						<tr>
							<th scope="row">System Fee</th>
							<td>PHP 2.00</td>
						</tr>
					</tbody>
				</table>
				<table class="table">
					<tbody>
						<tr>
							<th scope="row">Total Amount to Pay</th>
							<td>PHP 1002.00</td>
						</tr>
					</tbody>
				</table>
				<label class="title">Payment Method:</label>
				<button type="submit" class="btn btn-primary btn-block">Proceed to Payment</button>
			</div>
		</div>
	</div>
</div>
