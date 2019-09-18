<?php
  $subtotal = 0.00;
  $total_discount = 0.00;

	foreach ($orders as $value) {
         $subtotal += floatval($value['row_total']);
         $total_discount += floatval($value['row_total_discount']);
		?>

        <div class="order-row">
          <label>
          <?php    
              if(strlen($value['item_name'])>20){
                echo substr($value['item_name'].'...', 0,17);
              }
              else
              {
                  echo $value['item_name'];
              }
          ?>
          <?php
            if(strlen($value['unique_id'])>0)
            {
              ?>
                <br/><small>
                  <?= $value['unique_id']; ?>
                </small>
              <?php
            }
          ?>
          
          </label>
          
          <label class="pull-right">
            P <?php
                echo number_format($value['row_total'],2);
              ?>
          </label>
          <br/>
          <small>
            <b><?= $value['quantity']?> </b><?= $value['unit']?>
            at P <?= $value['price']?> / </b><?= $value['unit']?>
            <?php
                if(floatval($value['discount'])>0.00)
                {
                  ?>
                  <br/>
                    With <?= number_format(floatval($value['discount']),2) ?> % discount
                  <?php
                }
            ?>
          </small>
          <button class="btn btn-xs btn-default pull-right remove-order" id="<?= $value['id']?>"><i class="fa fa-remove"></i></button>
        </div>
		<?php
	}

  $total_tax = $subtotal * 0.12;
?>

<div class="top-10 padd-10">
    <label>Total</label> <label class="pull-right" id="left_pane_total">P <?= number_format($subtotal,2); ?></label><br/>
    <small style="display:none">Total Taxes</small> <small class="pull-right" id="left_pane_tax" style="display:none">P <?= number_format($total_tax,2); ?></small>
    <small>Total Discounts</small> <small class="pull-right" id="left_pane_discount">P <?= number_format($total_discount,2); ?></small>
</div>