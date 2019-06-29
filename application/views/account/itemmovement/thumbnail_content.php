
<div class="table-responsive">
    <table class='table table-bordered'>
        <tr>
            <th>Item Name</th>
            <th>Item Code</th>
            <th>Item Unit</th>
            <th style='text-align:center'>Action</th>
        </tr>
    <?php foreach ($items as $value): ?>
        <tr>
            <td><?= $value['item_name']?></td>
            <td><?= $value['item_code'] ?></td>
            <td><?= $value['unit'] ?></td>
            <td style='text-align:center'><a style="cursor:pointer" id="<?= $value['item_id']; ?>" class="add_to_item_tigger"><i class="fa fa-plus"> Add</i></a></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>