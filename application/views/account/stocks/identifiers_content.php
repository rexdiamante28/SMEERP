
    <ol>
        <?php foreach ($uids as $uid): ?>
            <li><strong><?=$uid['identifier']?> - <?=$uid['available'] == 1 ? '<span style="color: green"><i>Available</i></span>' : '<span style="color: red"><i>Not Available</i></span>' ?></strong></li>
        <?php endforeach;?>
    </ol>


