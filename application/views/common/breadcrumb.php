<?php

$links = count($breadcrumb);

if($links>1)
{
    ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php
                    $count = 0;
                    
                    foreach ($breadcrumb as $value) {
                        $count+=1;
                        if($count < $links)
                        {
                            ?>
                                <li class="breadcrumb-item <?= $value[0]; ?>">
                                    <a class="white-text" href="<?= $value[1]; ?>"><?= $value[2]; ?></a>
                                </li> 
                            <?php
                        }
                        
                    }

                ?>
            </ol>
        </nav>
    <?php
}

?>
<h5 class="text-uppercase page-title"><?= $breadcrumb[$links-1][2]; ?></h5>

