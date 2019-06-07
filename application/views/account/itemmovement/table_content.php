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
<?php
	foreach ($item_movements as $value) {
		?>
			<tr id="<?= $value['id']?>">
				<td><?= $value['branch_name']?></td>
				<td><?= $value['code']?></td>
				<td><?= $value['date']?></td>
				<td><?= $value['type']?></td>
				<td><?= $value['status']?></td>
				<td>
					<button id="<?= $value['id']?>" class="details btn btn-xs btn-default"><i class="fa fa-eye"></i></button>
					<button id="<?= $value['id']?>" class="remove btn btn-xs btn-default"><i class="fa fa-remove"></i></button>
					<button id="<?= $value['id']?>" class="update btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
				</td>
			</tr>
		<?php
	}
?>