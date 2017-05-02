<?php
$months = array(
	'Jan' => 'Jan',
	'Feb' => 'FÉV',
	'Mar' => 'MAR',
	'Apr' => 'AVR',
	'May' => 'MAI',
	'Jun' => 'JUI',
 	'Jul' => 'JUI',
 	'Aug' => 'Aou',
 	'Sep' => 'SEP',
 	'Oct' => 'OCT',
 	'Nov' => 'NOV',
 	'Dec' => 'DÉC',
	 );
?>

<span class="blog-page-post-single-date">
    <em class="blog-page-post-single-date-number"><?= get_post_time('d', true); ?></em>
    <?= $months[get_post_time('M', true)]; ?>
</span>
