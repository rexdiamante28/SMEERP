<thead>
	<tr>
		<th>Branch</th>
		<th>Ref Code</th>
		<th>Date</th>
		<th>Type</th>
		<th>Status</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
	
</tbody>
<?php foreach ($item_movements as $value): ?>
	
	<tr id="<?= $value['id']?>">
		<td><?= $value['branch_name']?></td>
		<td><?= $value['code']?></td>
		<td><?= $value['date']?></td>
		<td><?= $value['type']?></td>
		<td><?= $value['status']?></td>

		<?php if($value['from_outbound'] == 1): ?>
			<?php if($value['is_accepted'] == 1): ?>
				<td>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="details-acc btn btn-primary btn-block">View</button>
				</td>
			<?php else: ?>
				<td>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="details-inb btn btn-success btn-block">Accept</button>

				</td>
			<?php endif; ?>
		<?php else: ?>
			<?php if($value['is_accepted'] == 1): ?>
				<td>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="details-acc btn btn-primary btn-block">View</button>
				</td>
			<?php else: ?>
				<td>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="details btn btn-primary btn-block">Add Item</button
				</td>
			<?php endif; ?>
		<?php endif; ?>
	</tr>
<?php endforeach; ?>


<!-- <thead>
	<tr>
		<th>Branch</th>
		<th>Ref Code</th>
		<th>Date</th>
		<th>Type</th>
		<th>Status</th>
		<th>Options</th>
	</tr>
</thead>
<tbody> -->
	
<!-- </tbody>
<?php foreach ($item_movements as $value): ?>
	<tr id="<?= $value['id']?>">
		<td><?= $value['branch_name']?></td>
		<td><?= $value['code']?></td>
		<td><?= $value['date']?></td>
		<td><?= $value['type']?></td>
		<td><?= $value['status']?></td>

		<?php if($value['from_outbound'] == 1): ?>

			<?php if($value['is_accepted'] == 1): ?>
				<td>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="details-acc btn btn-xs btn-default"><i class="fa fa-eye"></i></button>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="disabled btn btn-xs btn-default"><i class="fa fa-remove"></i></button>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="disabled btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
				</td>
			<?php else: ?>
				<td>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="details-inb btn btn-xs btn-default"><i class="fa fa-eye"></i></button>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="disabled btn btn-xs btn-default"><i class="fa fa-remove"></i></button>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="disabled btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
				</td>
			<?php endif; ?>
		<?php else: ?>
			<?php if($value['is_accepted'] == 1): ?>
				<td>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="details-acc btn btn-xs btn-default"><i class="fa fa-eye"></i></button>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="disabled btn btn-xs btn-default"><i class="fa fa-remove"></i></button>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="disabled btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
				</td>
			<?php else: ?>
				<td>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="details btn btn-xs btn-default"><i class="fa fa-eye"></i></button>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="remove btn btn-xs btn-default"><i class="fa fa-remove"></i></button>
					<button id="<?= $value['id']?>" data-movement_type="<?= $value['type']?>" data-movement_id="<?=$value['id']?>" class="update btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
				</td>
			<?php endif; ?>
		<?php endif; ?>
	</tr>
<?php endforeach; ?> -->