<?php
$image			= $item->file;
$imageUrl		= $image->getFileUrl();
$imageAlt		= $image->altText;

$itemTitle		= $image->title;
$itemDesc		= $image->description;
$itemLink		= $image->link;

if( isset( $itemLink ) && strlen( $itemLink ) > 0 ) {

	$itemHtml		= "<li>
						<div class='wrap-item'>
							<div class='flip1'>
								<img src='$imageUrl' class='fluid' />
							</div>
							<div class='flip2'>
								<span class='title'>$itemTitle</span>
								<span class='info'>$itemDesc</span>
								<span class='link'><a href='$itemLink' class='btn small'>View</a></span>
							</div>
						</div>									
					</li>";
}
else {

	$itemHtml		= "<li>
						<div class='wrap-item'>
							<div class='flip1'>
								<img src='$imageUrl' class='fluid' />
							</div>
							<div class='flip2'>
								<span class='title'>$itemTitle</span>
								<span class='info'>$itemDesc</span>
							</div>
						</div>
					</li>";
}

return $itemHtml;
?>