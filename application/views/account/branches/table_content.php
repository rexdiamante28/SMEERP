<thead>
	<tr>
		<th>Branch Name</th>
		<th>Address</th>
		<th>Status</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
	
</tbody>
<?php
	foreach ($branches as $value) {
		?>
			<tr id="<?= $value['id']?>">
				<td><?= $value['branch_name']?></td>
				<td><?= $value['address']?></td>
				<td>
					<?php
						if($value['status']==='1')
						{
							?>
								<span class="label label-success">active</span>
							<?php
						}
						else
						{
							?>
								<span class="label label-danger">inactive</span>
							<?php
						}
					?>
				</td>
				<td>
					<button id="<?= $value['id']?>" class="remove btn btn-xs btn-default"><i class="fa fa-remove"></i></button>
					<button id="<?= $value['id']?>" class="update btn btn-xs btn-default"><i class="fa fa-pencil"></i></button>
				</td>
			</tr>
		<?php
	}
?>