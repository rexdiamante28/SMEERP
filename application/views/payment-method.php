 
<div class="page-container col-12 home corporate" id="pageContainer">
	<div class="logo text-center">
		<img class="w-100" src="<?=base_url("assets/img/logo-2.png") ?>">
	</div>
	<div id="payment-option">
		<h3 class="title text-center">Choose your Payment Method</h3>
		<div class="row payment-method">
			<div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 col-12 method-container" data-value="1">
				<div class="method w-100" value="credit-card">
					<div class="img-container">
						<img class="w-100" src="<?=base_url('assets/img/credit.png') ?>">
					</div>
					<div class="type-container w-100 text-center">
						<img src="<?=base_url('assets/img/mastercard-visa.png'); ?>">
					</div>
				</div>
			</div>
			<div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 col-12 method-container" data-value="2">
				<div class="method w-100" value="debit-card">
					<div class="img-container">
						<img class="w-100" src="<?=base_url('assets/img/debit.png') ?>">
					</div>
					<div class="type-container w-100 text-center">
						<img src="<?=base_url('assets/img/mastercard-visa.png'); ?>">
					</div>
				</div>
			</div>
			<div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 col-12 method-container" data-value="3">
				<div class="method online-banking w-100" value="online-banking">
					<div class="img-container">
						<img class="w-100" src="<?=base_url('assets/img/online-banking.png') ?>">
					</div>
					<div class="type-container w-100 text-center">
						<img src="<?=base_url('assets/img/bpi-bdo.png'); ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="payment-confirm">
		<h3 class="title text-center">Confirm Payment Method</h3>
		<div class="text-center">
			<a href="#" class="btn btn-secondary" id="changeMethod">Choose other payment method</a>
			<a href="#" class="btn btn-primary">Confirm Payment</a>
		</div>
		<div class="row">
			<div id="chosenMethod" class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-12 confirm-container">
			</div>
			<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-12 confirm-container">
				<table class="table">
					<tbody>
						<tr>
							<th scope="row">Amount to be Paid</th>
							<td><?= $currency.' '.$amount; ?></td>
						</tr>
						<tr id="card_origin_tr">
							<th scope="row">Card Origin</th>
							<td id="card_origin_td"></td>
						</tr>
						<!-- <tr>
							<th scope="row">System Fee</th>
							<td>PHP 1.00</td>									
						</tr>
						<tr>
							<th scope="row" class="font-weight-bold">Total Amount</th>
							<td class="font-weight-bold">PHP 1,000.00</td>									
						</tr> -->
						<div id="hidden_form" style="display:none;">
							<input type="text" id="currency" value="<?= $currency; ?>">
							<input type="text" id="amount" value="<?= $amount; ?>">
							<input type="text" id="email" value="<?= $email; ?>">
							<input type="text" id="refno" value="<?= $refno; ?>">
						</div>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>


	<div class="modal fade" id="card_origin_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Card Issued: </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          	<div class="form-group">
          		<button class="btn btn-lg btn-info btn-block" id="btn_local">Philippines</button>
          	</div>
          	<div class="form-group">
          		<button class="btn btn-lg btn-info btn-block" id="btn_international">Other Countries</button>
          	</div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

</div>
