<div id="payment_gateway_frame1">
	<div id="ppp_header">
		<div id="ppp_header1">
			<img src="<?= base_url('assets/img/logo-2.png');?>">
		</div>
		<div id="ppp_header2">
			<small>You are now connected to</small><br/>
			<b>PAYPANDA PAYMENT SERVICE</b>
		</div>
	</div>
	<div id="ppp_body1">

		<small id="ppp_body1_title">Secure Authenticated Merchant:</small>

		<p>
			<small>
				You are now connected to a secure payment site operated by Paypanda.com. Your payment details will be securely transmitted to the Bank,
				Card and Payment Companies for transaction process by using up to 256-bit SSL encryption.
			</small>
		</p>
	</div>

	<div id="ppp_body2">
		<br/><br/>
		<h2>PAYPANDA (Test PHP)</h2>

		<b>Select your payment method by clicking the logo below:</b>

		<br/><br/>

		<b>Pay By Credit Card and Debit Card</b> <br/><br/>

		<span id="ppp_visa">
			<img src="<?= base_url('assets/img/visa.png');?>">
		</span>

		<span id="ppp_mastercard">
			<img src="<?= base_url('assets/img/mastercard.png');?>">
		</span>


	</div>

	<div id="ppp_footer">
		<small>Copyright &copy; 2018 Paypanda Limited. All rights reserved</small>
	</div>

</div>




<div id="payment_gateway_frame2">
	<div id="ppp_selected_header">
		<span id="ppp_visa1">
			<img src="<?= base_url('assets/img/visa.png');?>">
		</span>

		<span id="ppp_mastercard1">
			<img src="<?= base_url('assets/img/mastercard.png');?>">
		</span>
	</div>
	<div id="ppp_header_1">
	</div>
	<div id="ppp_body_1" class="hhh">

		<small id="ppp_body1_title">Secure Authenticated Merchant:</small>

		<p>
			<small>
				You are now connected to a secure payment site operated by Paypanda.com. Your payment details will be securely transmitted to the bank,
				Card and Payment Companies for transaction process by using up to 256-bit SSL encryption.
			</small>
		</p>
	</div>

	<div id="ppp_body2">
		
		<div style="text-align:center;">
			<small>Transaction Information</small>
		</div>

		<div class="col-12">
			<div class="row">
				<div class="col-6">
					<b>Merchant Name :</b>
				</div>
				<div class="col-6">
					<small>Paypanda (test PHP)</small>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="row">
				<div class="col-6">
					<b>Merchant Reference No. :</b>
				</div>
				<div class="col-6">
					<small id="mrf"><?= $merchant_ref_no; ?></small>
				</div>
			</div>
		</div>
		<div class="col-12 hhh">
			<div class="row">
				<div class="col-6">
					<b>Transaction Amount :</b>
				</div>
				<div class="col-6">
					<small><?= $currency.'  '.$amount; ?></small>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="row">
				<div class="col-6">
					<b>Transaction IP Address :</b>
				</div>
				<div class="col-6">
					<small><?= $transaction_ip_address; ?></small>
				</div>
			</div>
		</div>


		<div style="text-align:center;" class="sss">
			<b>Payment successful!</b>
		</div>

		<div style="text-align:center;" class="hhh">
			<small>Please fill in the card information:</small>
		</div>

		<div class="col-12 hhh">
			<div class="row">
				<div class="col-6">
					<b>Card Number :</b>
				</div>
				<div class="col-6">
					<input type="text" id="card_number">
				</div>
			</div>
		</div>
		<div class="col-12 hhh">
			<div class="row">
				<div class="col-6">
					<b>Expiry Date (mm/yyyy) :</b>
				</div>
				<div class="col-6">
					<select type="text" id="month">
						<option>--</option>
						<option>01</option>
						<option>02</option>
						<option>03</option>
						<option>04</option>
						<option>05</option>
						<option>06</option>
						<option>07</option>
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
					</select>
					<select type="text" id="year">
						<option>--</option>
						<option>2018</option>
						<option>2019</option>
						<option>2020</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-12 hhh">
			<div class="row">
				<div class="col-6">
					<b>Name as shown on card :</b>
				</div>
				<div class="col-6">
					<input type="text" id="name_on_card">
				</div>
			</div>
		</div>
		<div class="col-12 hhh">
			<div class="row">
				<div class="col-6">
					<b>Card Verification Number :</b>
				</div>
				<div class="col-6">
					<input type="text" id="ccv">
				</div>
			</div>
		</div>
		<div class="col-12 hhh">
			<div class="row">
				<div class="col-6">
					<b>Email Address :</b>
				</div>
				<div class="col-6">
					<input type="text" id="email">
				</div>
			</div>
		</div>
		<div class="col-12 text-center hhh">
			<br/><br/>
			<div class="row">
				<div class="col-12">
					<button type="button" id="submit_btn" class="paybtn">Submit</button>
					<button type="button" id="cancel_btn" class="paybtn">Cancel</button>
				</div>
			</div>
		</div>

		<div class="col-12 text-center hhh">
			<br/><br/>
			<div class="row">
				<div class="col-12">
					<p>
						<b>Note: As certain card-issuing banks might not yet be ready for Internet Transactions,</b> 
						<small>please contact yout card-issuing bank for any problems in using your card for transactions via Paypanda.</small>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div id="ppp_footer">
		<small>Copyright &copy; 2018 Paypanda Limited. All rights reserved</small>
	</div>

</div>