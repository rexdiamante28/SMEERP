<div id="payment_gateway_frame2">
	<div id="ppp_selected_header">
		<span id="ppp_visa1">
			<img src="<?= base_url('assets/img/logo-2.png');?>">
		</span>
	</div>
	<div id="ppp_header_1">
	</div>
	<div id="ppp_body_1" class="hhh">

		<small id="ppp_body1_title">Secure Authenticated Merchant:</small>

		<p>
			<small>
				You are now connected to a secure payment site operated by Paypanda.com. Your payment details will be securely transmitted to the Bank,
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

		<div style="text-align:center;" class="sss">
			<b>Payment pending!</b>
		</div>

		<div class="col-12 hhh">
			<div class="row">
				<div class="col-6">
					<b>Source :</b>
				</div>
				<div class="col-6">
					<select id="payment_source" style="width:260px;">
						<option selected="selected" value="">---- SELECT A PAYMENT OPTION ----</option>
						<option value="">------ OVER THE COUNTER BANKS ------</option>
						<option value="1">Paypanda Bogus Bank</option>
						<option value="">----- OVER-THE-COUNTER OTHERS -----</option>
						<option value="2">Paypanda Bogus Lhuillier</option>
					</select>
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