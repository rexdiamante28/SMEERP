<thead>
	<tr>
		<th>Item Unit</th>
		<th>Description</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
	
</tbody>
<?php
	foreach ($itemunits as $value) {
		?>
			<tr id="<?= $value['id']?>">
				<td><?= $value['unit']?></td>
				<td><?= $value['description']?></td>
				<td>
					<button id="<?= $value['id']?>" class="remove btn btn-xs btn-default"><i class="fa fa-remove"></i></button>
					<button id="<?= $value['id']?>" class="update btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
				</td>
			</tr>
		<?php
	}
?>