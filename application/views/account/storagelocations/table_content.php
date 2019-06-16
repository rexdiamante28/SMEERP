<thead>
	<tr>
		<th>Branch Name</th>
		<th>Storage</th>
		<th>Description</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
	
</tbody>
<?php
	foreach ($storagelocations as $value) {
		?>
			<tr id="<?= $value['id']?>">
				<td><?= $value['branch_name']?></td>
				<td><?= $value['name']?></td>
				<td><?= $value['description']?></td>
				<td>
					<button id="<?= $value['id']?>" class="remove btn btn-xs btn-default"><i class="fa fa-remove"></i></button>
					<button id="<?= $value['id']?>" class="update btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
				</td>
			</tr>
		<?php
	}
?>