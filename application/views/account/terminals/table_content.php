<thead>
	<tr>
		<th>Branch Name</th>
		<th>Terminal Code</th>
		<th>Terminal Number</th>
		<th></th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
	
</tbody>
<?php
	foreach ($terminals as $value) {
		?>
			<tr id="<?= $value['id']?>">
				<td><?= $value['branch_name']?></td>
				<td><?= $value['terminal_code']?></td>
				<td><?= $value['terminal_number']?></td>
				<td>
					<?php
						if($value['status']==='Inactive')
						{
							?>
								<button class="btn btn-xs btn-success newsession" id="<?= $value['id']?>">Open POS</button>
							<?php
						}
						else
						{
							?>
								<button class="btn btn-xs btn-warning newsession">Close Session</button>
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