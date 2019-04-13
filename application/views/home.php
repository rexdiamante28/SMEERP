
<div class="page-container col-12 home">
	<a href="<?=base_url('') ?>">
		<div class="logo text-center col-lg-4 col-6">
			<img class="w-100" src="<?=base_url("assets/img/logo-2.png") ?>">
		</div>
	</a>

	<h3 class="title text-center">Billing Details</h3>
	<form>
		<fieldset>
			<div class="row">
				<div class="col-lg-7 col-12 content-container left">
					<div class="content">
						<div class="row">
							<div class="form-group col-12">
								<label for="exampleInputEmail1">Bill Reference Number <span class="text-red">(Required)</span></label>
								<input type="number" class="form-control" placeholder="">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6 col-12">
								<label for="exampleInputEmail1">Bill First Name</label>
								<input type="text" class="form-control" placeholder="">
							</div>
							<div class="form-group col-md-6 col-12">
								<label for="exampleInputEmail1">Bill Last Name</label>
								<input type="text" class="form-control" placeholder="">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6 col-12">
								<label class="control-label">Bill Amount Due</label>
								<div class="form-group">
									<div class="input-group mb-3">
										<input type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
										<div class="input-group-append">
											<span class="input-group-text">.00</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6 col-12">
								<label for="exampleInputEmail1">Bill Contact</label>
								<input type="number" class="form-control" placeholder="">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12">
								<label for="exampleSelect1">Payment Recipient: <span class="text-red">(Required)</span></label>
								<select class="form-control" id="exampleSelect1">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-12 content-container right">
					<div class="content">
						<div class="row">
							<div class="form-group col-12">
								<label class="control-label">Amount to Pay</label>
								<div class="form-group">
									<div class="input-group mb-3">
										<input type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
										<div class="input-group-append">
											<span class="input-group-text">.00</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<table class="table">
							<tbody>
								<tr>
									<th scope="row">System Fee</th>
									<td></td>
									<td>PHP 1.00</td>
								</tr>
								<tr>
									<th scope="row">Amount Total</th>
									<td></td>
									<td>PHP 2.00</td>									
								</tr>
							</tbody>
						</table>
						<label class="title">Choose your method of payment</label>
						<fieldset class="payment-method">
							<div class="form-group">
								<div class="row">
									<div class="custom-control custom-radio col-6">
										<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked="">
										<label class="custom-control-label" for="customRadio1">Credit Card</label>
									</div>
									<div class="custom-control custom-radio col-6">
										<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
										<label class="custom-control-label" for="customRadio2">Debit Card</label>
									</div>
									<div class="custom-control custom-radio col-6">
										<input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
										<label class="custom-control-label" for="customRadio3">Online Banking</label>
									</div>
									<div class="custom-control custom-radio col-6">
										<input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
										<label class="custom-control-label" for="customRadio4">Over the Counter</label>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="conditions">
							<p>I hereby confirm that I am legally entitled to use the payment method selected herein, furthermore the account details are correctly entered.</p>
							<fieldset>
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Check to confirm</label>
									</div>
								</div>
							</fieldset>
						</div> 
						<button type="submit" class="btn btn-primary btn-block">Proceed to Checkout</button>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div>
