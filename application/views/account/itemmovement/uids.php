
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

				foreach ($uids as $value) {
					?>	
						<tr id="uid_tr<?= $value['id']; ?>">
							<td>
								<input type="text" class="form_control" id="uid<?= $value['id']; ?>" value="<?= $value['identifier'] ?>">
							</td>
							<td>
								<button class="btn btn-default btn-xs">
									<i class="fa fa-check update_uid_button" id="uid_button<?= $value['id']; ?>"></i>
								</button>
								<button class="btn btn-default btn-xs">
									<i class="fa fa-remove remove_uid_button" id="uidd_button<?= $value['id']; ?>"></i>
								</button>
							</td>
						</tr>
					<?php
				}

			?>
		</tbody>
	</table>
</div>
