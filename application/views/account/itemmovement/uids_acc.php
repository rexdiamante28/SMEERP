
<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>IMEI</th>
				<th>Color</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// print_r($uids);die();
				foreach ($uids as $value) {
					?>	
						<tr>
							<td width="50%">
								<label><?= $value['identifier'] ?></label>
							</td>						
							<td width="50%"> 
								<label><?= $value['color'] ?></label>
							</td>
						
						</tr>
					<?php
				}

			?>
		</tbody>
	</table>
</div>
