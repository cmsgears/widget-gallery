<?php
$imageUrl		= $item->getFileUrl();
$imageAlt		= $item->altText;

$itemTitle		= $item->title;
$itemDesc		= $item->description;
$itemLink		= $item->link;
?>
<li>
	<div class='flip-container' ontouchstart="this.classList.toggle('hover');">
		<div class='flipper'>
    		<div class='front'>
				<img src='<?=$imageUrl?>' class='fluid' alt='<?=$imageAlt?>' />
    		</div>
    		<div class='back'>
				<span class='title'><?=$itemTitle?></span>
				<span class='info'><?=$itemDesc?></span>
				<?php if( isset( $itemLink ) ) { ?>
					<span class='link'><a href='<?=$itemLink?>' class='btn small'>View</a></span>
				<?php } ?>
    		</div>
  		</div>
	</div>
</li>