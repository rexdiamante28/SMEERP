<div class="container-fluid">
	<div class="row">
		<div class="btn-group ml-auto" role="group" aria-label="Button group with nested dropdown">
			<button type="button" class="btn btn-primary">Welcome, Tony</button>
			<div class="btn-group" role="group">
				<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 48px, 0px);">
					<!-- <a class="dropdown-item" href="#">My Account</a> -->
					<a class="dropdown-item" href="<?=base_url('main/history') ?>">Billing History</a>
					<a class="dropdown-item" href="#">Logout</a>
				</div>
			</div>
		</div>
	</div>
</div>