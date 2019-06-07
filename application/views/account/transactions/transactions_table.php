<thead>
	<tr>
		<th>OR Number</th>
		<th>Cashier</th>
		<th>Payment Details</th>
		<th>Payment Status</th>
		<th>Transaction Date</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
	
</tbody>
<?php
	foreach ($transactions as $value) {
		?>
			<tr id="<?= $value['id']?>">
				<td>
					<label><?= $value['or_number']?></label><br>
					<small>Terminal Code: <?= $value['branch_name'];?></small><br/>
					<b><small> Remarks: <?= $value['remarks'];?></small></b><br/>
				</td>
				<td>
					<label><?= $value['first_name'].' '.$value['last_name']?></label><br/>
					<small>Terminal Code: <?= $value['terminal_code'];?></small><br/>
					<small>Terminal Number: <?= $value['terminal_number'];;?></small><br/>
				</td>
				<td>
					<small> Total Amount: P <?= number_format($value['total'],2);?></small><br/>
					<small> Total Tax: P <?= number_format($value['tax'],2);?></small><br/>
				</td>
				<td>
					<small> Payment status :  <b><?= doubleval($value['balance']) < 1 ? 'Fully Paid' : 'Partially Paid';?></b></small><br/>
					<?php
						if(doubleval($value['balance']) > 0)
						{
							?>
								<small> Paid Amount: P <?= number_format($value['amount_due'],2);?></small><br/>
								<small> Total Balance: P <?= number_format($value['balance'],2);?></small><br/>
								<small> Balance Due Date: <?= $value['due_date'];?></small><br/>
							<?php
						}
					?>
				</td>
				<td><?= $value['date_time']?></td>
				<td>
					<a href="<?= base_url().'pos/print_receipt/'.$value['id']; ?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>

					<?php
						if(doubleval($value['balance']) > 0)
						{
							?>
								<button  class="btn btn-xs btn-default receive_payment" id="<?= $value['id']; ?>"><i class="fa fa-download"></i></button>
							<?php
						}
					?>

				</td>
			</tr>
		<?php
	}
?>