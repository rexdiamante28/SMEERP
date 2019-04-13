<?php

	foreach ($project_logs as $log) {
		?>
			<div class="log-entry col-12">
				<h5>
					<img class="img rounded-circle" style="width:30px;" src="<?= base_url('assets/uploads/avatars/').$log['avatar']; ?>"><br/>
					<b><?= $log['name'] ?></b><br/>
					<small class="text-muted"><?= $log['created'] ?></small><br/>
				</h5>
				<p>
					<?= $log['log']; ?>
				</p>
				<hr/>
			</div>
		<?php
	}

?>