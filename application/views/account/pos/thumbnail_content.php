<?php
	foreach ($items as $value) {
		?>
        <span class="store_items" id="item_movement_item_id<?= $value['item_movement_item_id'];?>" data-unique="<?= $value['has_unique_identifier']; ?>">
            <img class="col-xs-12 no-padd" src="<?= base_url().'assets/images/items/'.$value['item_image']?>">
            <span class="details">
                <p>
                  <small>
                  <?php 
                      
                      if(strlen($value['item_name'])>20){
                        echo substr($value['item_name'].'...', 0,17);
                      }
                      else
                      {
                          echo $value['item_name'];
                      }
                  ?>
                  </small>
                </p>
                <p class="label label-info"><b>P <?= $value['selling_price']?></b> </p> &nbsp;/ 
                <small><?= $value['unit']?></small>
            </span>
        </span>
		<?php
	}
?>