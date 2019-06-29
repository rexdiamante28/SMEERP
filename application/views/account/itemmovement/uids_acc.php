
<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>UID</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// print_r($uids);die();
				foreach ($uids as $value) {
					?>	
						<tr id="uid_tr<?= $value['id']; ?>">
							<td>
								<input type="text" class="form_control" id="uid<?= $value['id']; ?>" value="<?= $value['identifier'] ?>">
							</td>
							
						
							<td></td>
						
						</tr>
					<?php
				}

			?>
		</tbody>
	</table>
</div>
