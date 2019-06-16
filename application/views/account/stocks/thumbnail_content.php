<?php
	foreach ($items as $value) {
		?>
			<div class="col-md-55">
        <div class="thumbnail point">
          <div class="image view view-first">
            <img style="width: 100%; display: block;" src="<?= base_url().'assets/images/items/'.$value['item_image']?>" alt="image" />
            <div class="mask point">
              <p>
                <strong>
                  <?= $value['item_code'] ?>
                </strong>
              </p>
              <div class="tools tools-bottom">
                <a id="<?= $value['store_item_id']; ?>" class="update"><i class="fa fa-eye"></i></a>
              </div>
            </div>
          </div>
          <div class="caption">
            <p><b><?= $value['item_name']?></b></p>
            <p><strong>P <?= number_format($value['price'],2); ?></strong></p>
          </div>
        </div>
      </div>
		<?php
	}
?>