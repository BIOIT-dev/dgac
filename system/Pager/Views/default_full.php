<?php

/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */

$pager->setSurroundCount(2);

$primero ='';
$ultimo ='';

$numItems = count($pager->links());
$i=0;
foreach($pager->links()  as $key => $link) {

	$por = explode("/", $link['uri']);

	$link['uri'] = $por[7];

    if ($i == 0){
    	$primero = $link['uri'];
    }

 	if(++$i === $numItems) {
    	$ultimo = $link['uri'];
    }
    
}

?> 

<div class="d-flex justify-content-end">
	 <label>Pagina  <?=$pager->current?> / <?=$pager->pageCount?> </label>
</div>

    <div   class="d-flex justify-content-end paging_simple_numbers" >
			<ul class="pagination">
				
				<?php if ($pager->hasPrevious()) : ?>
					<li class="paginate_button page-item previous " id="default_order_previous">
		                <a href="<?=$pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>" aria-controls="default_order" data-dt-idx="0" tabindex="0" class="page-link">
		                	<?= lang('Pager.first') ?>
		                </a>
		            </li>

		            <!--<li class="paginate_button page-item previous " id="default_order_previous">
		                <a href="<?=$pager->getPrevious() ?>" aria-controls="default_order" data-dt-idx="0" tabindex="0" class="page-link">Previous
		                </a>
		            </li>-->
		        <?php endif ?>

				<?php foreach ($pager->links() as $link) : 
				
						$por = explode("/", $link['uri']);

						$link['uri'] = $por[7];

						if($link['active'])
							$class = "paginate_button page-item active";
						else 
							$class = "paginate_button page-item";
						?>
						<li class="<?=$class?>">
			                <a href="<?= $link['uri'] ?>" aria-controls="default_order" data-dt-idx="1" tabindex="0" class="page-link">
			                  <?= $link['title'] ?>
			                </a>
		            	</li>
				
				<?php endforeach ?>

				<?php if ($pager->hasNext()) : ?>
					<!--<li class="page-item paginate_button ">
						<a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>" class="page-link">
							<span aria-hidden="true"><?= lang('Pager.next') ?></span>
						</a>
					</li>-->
					<li class="page-item">
						<a href="<?= $ultimo ?>" aria-label="<?= lang('Pager.last') ?>" class="page-link">
							<span aria-hidden="true"><?= lang('Pager.last') ?></span>
						</a>
					</li>
				<?php endif ?>
			</ul>
	</div>

