<div id="report_body">
    <?php  
        foreach ($items as $value){
            $branch_name = $value->branch_name;
            break;
        }
     ?>
    <div id="receipt_header" class="text-center" >
        <label class="bold">JSL GADGETS</label><br/>
        <small><?= $branch->branch_name;?></small><br/>
        <small>Inventory Report</small>
    </div>
    <div class="top-10 bottom-10">
       <table class="table table-bordered">
          <thead>
              <th style="text-align:center">Item Code</th>
              <th style="text-align:center">Item Name</th>
              <th style="text-align:center">Supplier's Price</th>
              <th style="text-align:center">Selling Price</th>
              <th style="text-align:center">Unit</th>
              <th style="text-align:center">Stock</th>
              <th style="text-align:center">IMEI</th>
              <th style="text-align:center">Availability by Color</th>
          </thead>
          <tbody>
            <?php
                foreach ($items as $value) {

                    $uids = $this->stock_model->get_unique_ids($value->store_item_id);
                    $uids_color = $this->stock_model->get_unique_ids_color($value->store_item_id);
                    $data = $this->stock_model->get_itemmovement_id_using_storeitemid($value->store_item_id);

                  ?>
                    <tr>
                      <td><small><?= $value->item_code; ?></small></td>
                      <td><small><?= $value->item_name; ?></small></td>
                      <td style="text-align:right"><small>P <?= number_format($data['supplier_price'],2); ?></small></td>
                      <td style="text-align:right"><small>P <?= number_format($data['selling_price'],2); ?></small></td>
                      <td><small><?= $value->unit;?></small></td>
                      <td style="text-align:right"><small><?= $value->stock_count;?></small></td>
                      <td>
                        <small>
                            <ol>
                                <?php if(!empty($uids)): ?>
                                <?php foreach ($uids->result_array() as $uid): ?>
                                    <?php if($uid['available'] == 1): ?>
                                    <li><strong><?=$uid['identifier']?> - <span><?=$uid['color']?></span> - <span style="color: green"><i>Available</i></span></strong></li>
                                    <?php endif; ?>
                                <?php endforeach;?>
                                <?php endif; ?>
                            </ol>
                        </small>
                    </td>                      
                    <td>
                        <small>
                            <?php if($value->has_unique_identifier == 1): ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Color</th>
                                    <th>Available</th>
                                </tr>
                                <?php  $total = 0; ?>
                                <?php foreach ($uids_color->result_array() as $uidc): ?>
                                    <?php  $total += $uidc['count']; ?>
                                    <tr>
                                        <td><?=$uidc['color']?></td>
                                        <td style="text-align: right"><?=$uidc['count']?></td>
                                    </tr>
                                <?php endforeach;?>
                                    <tr>
                                        <th>Total</th>
                                        <td style="text-align: right"><?=$total?></td>
                                    </tr>
                            </table>
                            <?php endif; ?>
                        </small>
                    </td>
                    </tr>
                  <?php
                }
            ?>
          </tbody>
       </table>
    </div>
    <div>

    </div>
</div>