
<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>IMEI</th>
				<th>Color</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($uids as $value) {
					?>	
						<tr id="uid_tr<?= $value['id']; ?>">
							<td>
								<input type="text" class="form_control" id="uid<?= $value['id']; ?>" value="<?= $value['identifier'] ?>">
							</td>
							<td>
								<input type="text" class="form_control" id="cid<?= $value['id']; ?>" 
								value="<?= $value['color'] ?>"
								<?=$value['type'] == 'Inbound'? '' : "readonly"?> >
							</td>
							<?php if($value['from_outbound'] !=1 || $value['is_accepted']!=1): ?>
							<td>
								<button class="btn btn-default btn-xs">
									<i class="fa fa-check update_uid_button" id="uid_button<?= $value['id']; ?>" data-item_id="<?=$item_id?>" data-branch_id="<?=$branch_id?>"></i>
								</button>
								<button class="btn btn-default btn-xs">
									<i class="fa fa-remove remove_uid_button" id="uidd_button<?= $value['id']; ?>"></i>
								</button>
							</td>
							<?php else: ?>
								<td></td>
							<?php endif; ?>
						</tr>
					<?php
				}

			?>
		</tbody>
	</table>
</div>
