<?php
	foreach ($items as $value) {
		?>
			<div class="col-md-55">
              <div class="thumbnail point">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="<?= base_url().'assets/images/items/'.$value['item_image']?>" alt="image" />
                  <div class="mask point">
                    <p><strong> <?= $value['item_code'] ?></strong></p>
                    <div class="tools tools-bottom">
                      <a id="<?= $value['item_id']; ?>" class="add_to_item_tigger"><i class="fa fa-plus"></i></a>
                    </div>
                  </div>
                </div>
                <div class="caption">
                  <p><b><?= $value['item_name']?></b></p>
                  <p><strong>Unit: <?= $value['unit']; ?></strong></p>
                </div>
              </div>
            </div>
		<?php
	}
?>