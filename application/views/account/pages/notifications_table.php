<thead>
	<tr>
		<th>Notification</th>
		<th>Date</th>
		<th>Status</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
	
</tbody>
<?php
	foreach ($notifications as $value) {
		?>
			<tr id="<?= $value['id']?>">
				<td><?= $value['notification']?></td>
				<td><?= $value['date']?></td>
				<td>
					<?php
						if($value['important']!=='1')
						{
							?>
								<label class="label label-default">Regular</button>
							<?php
						}
						else
						{
							?>
								<label class="label label-danger">Important</button>
							<?php
						}
						
					?>	
				</td>
				<td>
					<button id="<?= $value['id'];?>" class="important btn btn-xs btn-default">Important</button>
					<?php
						if($value['checked']==='0')
						{
							?>
								<button id="<?= $value['id'];?>" class="read btn btn-xs btn-default">Read</button>
							<?php
						}	
						
					?>	
				</td>
			</tr>
		<?php
	}
?>