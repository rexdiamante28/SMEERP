<?php
	foreach ($users as $value) {
		?>
			     <div class="col-md-55">
              <div class="thumbnail point">
                <div class="image view view-first" style="padding:0px 20px 30px 20px;">
                  <img style="width: 100%; display: block;" src="<?= base_url().'assets/images/avatar/'.$value['avatar']?>" alt="image" />
                  <div class="mask point">
                    <p><strong> <?= $value['username'] ?></strong></p>
                    <div class="tools tools-bottom">
                      <a id="<?= $value['id']; ?>" class="update"><i class="fa fa-pencil"></i></a>
                      <a id="<?= $value['id']; ?>" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                </div>
                <div class="caption">
                  <p><b><?= $value['first_name'].' '.$value['last_name']?></b></p>
                  <p><strong><?= $value['mobile_number']?></strong></p>
                </div>
              </div>
            </div>
		<?php
	}
?>