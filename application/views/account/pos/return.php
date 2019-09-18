<div id="receipt_body">
  <br/><br/>
    <div id="receipt_header" class="text-center" style="border-bottom:dotted 1px #F0EEEE;">
        <label class="bold">JSL Gadgets</label><br/>
        <small><?= $transaction['branch_name'];?></small>
    </div>
    <div class="top-10 bottom-10" style="border-bottom:dotted 1px #F0EEEE;">
        <small>Cashier: <?= $transaction['first_name'].' '.$transaction['last_name']; ?></small><br/>
        <small>Date   : <?= $transaction['date_time']; ?></small><br/>
        <small>OR #   : <?= $transaction['or_number']; ?></small><br/>
        <small>POS Code : <?= $transaction['terminal_code']; ?></small><br/>
        <small>POS # : <?= $transaction['terminal_number']; ?></small>
    </div>
    <div>
        <?php
        $total_discount = 0.00;
          foreach ($transaction_items as $value) {
            $total_discount += $value['row_total_discount'];
            ?>

                <div class="top-5" style="border-bottom:dotted 1px #F0EEEE;">
                  <small class="pull-left">
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
                          <br/><br/><small>
                            <?= $value['unique_id']; ?>
                          </small>
                        <?php
                      }
                    ?>

                  </small>
                  <small class="pull-right">
                    P <?php
                        echo number_format($value['row_total'],2);
                      ?>
                  </small>
                  <br/>
                  <br/>
                  <small class="">
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
                  <button class="pull-right btn btn-xs btn-primary item-return-btn" id="item_return_btn<?= $value['transaction_item_id']; ?>" data-itid="<?= $value['transaction_item_id']; ?>">Return</button>
                </div>
            <?php
          }
        ?>
    </div>
    <div class="top-10" style="border-bottom:dotted 1px #F0EEEE;">
        <b><small class="pull-left">Total        :</small> <small class="pull-right">P <?= number_format($transaction['total'],2); ?></small></b><br/>
        <b><small class="pull-left">Change       :</small> <small class="pull-right">P <?= number_format($transaction['payment_change'],2); ?></small></b><br/>
        <!-- <b><small class="pull-left">Taxes        :</small> <small class="pull-right">P <?= number_format($transaction['tax'],2); ?></small></b><br/> -->
        <b><small class="pull-left">Discounts    :</small> <small class="pull-right">P <?= number_format($total_discount,2); ?></small></b><br/>
    </div>
    <div class="text-center top-10">
      <small>This serves as your official receipt and is valid 5 years from the date of purchase.</small><br>
      <small>Thank you! Looking forward to seeing you again in our stores!</small>
    </div>
</div>