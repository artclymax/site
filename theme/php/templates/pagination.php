<?php
$custom_query = get_query_var('custom_query');

$query_obj = $custom_query ? $custom_query : $GLOBALS['wp_query'];

if ($query_obj->max_num_pages > 1) {
	$big = 999999999;

	$pagination_args = array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $query_obj->max_num_pages,
		'mid_size' => 2,
		'prev_text' => '<span class="arrow left"></span>',
		'next_text' => '<span class="arrow right"></span>',
		'before_page_number' => '<span class="screen-reader-text">Страница </span>',
		'aria_current' => 'page'
	);

	echo '<div class="pagination">';
	echo paginate_links($pagination_args);
	echo '</div>';
}
?>
