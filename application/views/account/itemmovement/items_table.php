<thead>
	<tr>
		<th></th>
		<th>Item</th>
		<th>Quantity</th>
		<th>UID Encoding</th>
		<th>Stock</th>
		<th>Remarks</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody>
	
</tbody>
<?php foreach ($item_movement_items as $value): ?>
	
	<tr id="<?= $value['id']?>">
		<td><img class="img-thum" style="width:70px;" src="<?= base_url().'assets/images/items/'.$value['item_image']?>"></td>
		<td>
			<b><?= $value['item_code']?></b><br/>
			<?= $value['item_name']?>
		</td>
		<td>
			<?= $value['quantity']?><br/>
			Unit: <?=  $value['unit'] ?>
		</td>
		<td>
			<?= $value['id_set']; ?> / <?= $value['id_not_set']; ?>
		</td>
		<td>
			<?= $value['stock']?><br/>
			Unit: <?=  $value['unit'] ?>
		</td>
		<td><?= $value['remarks']?></td>

		<?php if($movement_info['from_outbound'] != 1 && $movement_info['is_accepted'] != 1 ): ?>
		<td>
			<button class="btn btn-default btn-xs view_identifiers" id="<?= $value['id']; ?>">
				<i class="fa fa-eye"></i>
			</button>
		</td>
		<?php else: ?>
			<td>
				<button class="btn btn-default btn-xs view_identifiers_acc" id="<?= $value['id']; ?>">
					<i class="fa fa-eye"></i>
				</button>
			</td>
		<?php endif; ?>
	</tr>

<?php endforeach; ?>