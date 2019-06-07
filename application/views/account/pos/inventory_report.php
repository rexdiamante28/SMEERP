<div id="report_body">
    <div id="receipt_header" class="text-center" >
        <label class="bold">Von Micheal's Auto Parts Shop</label><br/>
        <small><?= $branch->branch_name;?></small><br/>
        <small>Inventory Report</small>
    </div>
    <div class="top-10 bottom-10">
       <table class="table">
          <thead>
              <th>Item Code</th>
              <th>Item Name</th>
              <th>Price / Unit</th>
              <th>Category</th>
              <th>Stock</th>
              <th>Min / Max</th>
          </thead>
          <tbody>
            <?php
                foreach ($items as $value) {
                  ?>
                    <tr>
                      <td><small><?= $value->item_code; ?></small></td>
                      <td><small><?= $value->item_name; ?></small></td>
                      <td><small>P <?= number_format($value->price,2); ?> / <?= $value->unit; ?></small></td>
                      <td><small><?= $value->category_string; ?></small></td>
                      <td><small><?= $value->stock; ?> <?= $value->unit; ?>/s</small></td>
                      <td><small><?= $value->threshold_max; ?> <?= $value->unit; ?>/s<br/><?= $value->threshold_min; ?> <?= $value->unit; ?>/s</small></td>
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