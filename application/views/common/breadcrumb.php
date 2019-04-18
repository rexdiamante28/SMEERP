<div class="bc-icons-2 card mb-4">
    <ol class="breadcrumb mb-0 main-bg px-4 py-3">
    	<?php
    		$count = 0;
    		$links = count($breadcrumb);
    		foreach ($breadcrumb as $value) {
    			$count+=1;
    			?>
    				<li class="breadcrumb-item <?= $value[0]; ?>">
    					<a class="white-text" href="<?= $value[1]; ?>"><?= $value[2]; ?></a>
    					<?php
    						if($count<$links)
    						{
    							?>
    								<i class="fa fa-chevron-right mx-2 white-text" aria-hidden="true"></i>
    							<?php
    						}
    					?>
    				</li> 
    			<?php
    		}

    	?>

    </ol>
</div>