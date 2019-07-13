
<div class="table-responsive">
   <table class="table table-bordered">
        <tr>
            <th>Item Name</th>
            <th>Item Price</th>
            <th>Item Unit</th>
        </tr>
      <?php foreach ($items as $value): ?> 
        <tr>
            <td>
                <span 
                    class="store_items" id="item_movement_item_id<?= $value['item_movement_item_id']?>" 
                    data-unique = "<?= $value['has_unique_identifier']?>" 
                    data-storeitemid ="<?=$value['store_item_id']?>" 
                    data-itemid = "<?=$value['itemid']?>" 
                    data-sellingprice = "<?=$value['selling_price']?>">
                    <?=$value['item_name']?>
                </span>
            </td>
            <td><p class="label label-info">P <?=$value['selling_price']?></p></td>
            <td><small><?= $value['unit']?></small></td>
        </tr>
      <?php endforeach; ?>

   </table>
</div>