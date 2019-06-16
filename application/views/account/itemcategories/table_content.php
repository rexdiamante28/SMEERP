<thead>
	<tr>
		<th>Category</th>
		<th>Parent Category</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
	
</tbody>
<?php
	foreach ($itemcategories as $value) {
		?>
			<tr id="<?= $value['id']?>">
				<td><?= $value['category_string']?></td>
				<td><?= $value['parent_category_string']?></td>
				<td>
					<button id="<?= $value['id']?>" class="remove btn btn-xs btn-default"><i class="fa fa-remove"></i></button>
					<button id="<?= $value['id']?>" class="update btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
				</td>
			</tr>
		<?php
	}
?>