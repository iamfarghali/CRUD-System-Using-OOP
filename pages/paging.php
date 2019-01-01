<ul class="pagination">
<?php
	if ( $page > 1 ) { ?>
		<li>
			<a href="<?= $pageUrl ?>" title="Go to the first page. ">First</a>
		</li>
	<?php }

	// calculate total pages 
	$totalPages = ceil($totalRow / $recordsPerPage);
	// range to links to show
	$range = 2;

	$initNum = $page - $range;
	$coditionLimitNum = ($page + $range) + 1 ;

	for ($i = $initNum; $i < $coditionLimitNum; $i++) {
		if ( ($i > 0) && ($i <= $totalPages)) {
			// current page
			if ($i == $page) { ?>
				<li class="active">
					<a href="#">
						<?= $i ?>
						<span class="sr-only">(current)</span>
					</a>
				</li>
			<?php } 
			else { ?>
				<li>
					<a href="<?= $pageUrl.'?page='.$i ?>">
						<?= $i ?>
					</a>
				</li>
			<?php }
		}
	}

	// button for last page
	if ($page < $totalPages) { ?>
		<li>
			<a href="<?= $pageUrl.'?page='.$totalPages ?>" title="Go to last Page.">Last</a>
		</li>
	<?php }

?>
</ul>