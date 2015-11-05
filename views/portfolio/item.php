<?php
$imageUrl		= $item->getFileUrl();
$imageAlt		= $item->altText;

$itemTitle		= $item->title;
$itemDesc		= $item->description;
$itemLink		= $item->link;
?>
<li>
	<div class="colf3">
		<div class='flipper' ontouchstart="this.classList.toggle('hover');">
			<div class='flipper-content'>
	    		<div class='flipper-face flipper-front'>
					<img src='<?=$imageUrl?>' class='fluid' alt='<?=$imageAlt?>' />
	    		</div>
	    		<div class='flipper-face flipper-back center'>
					<h6 class='title'><?=$itemTitle?></h6>
					<span class='info'><?=$itemDesc?></span>
					<?php if( isset( $itemLink ) ) { ?>
						<div class='link'><a href='<?=$itemLink?>' class='btn small'>View</a></div>
					<?php } ?>
	    		</div>
	  		</div>
		</div>
	</div>	
</li>