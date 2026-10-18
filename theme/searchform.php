<?php
$classes = isset($args['class']) ? $args['class'] : '';
?>

<div class="search-form <?= $classes ?>">
	<form role="search" method="get" id="searchform<?= '-' . $classes ?>" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
		<div class="search-field-wrapper">
			<input class="search-field" type="text" value="" name="s" id="s<?= '-' . $classes ?>" placeholder="Поиск по сайту" autocomplete="on" aria-label="Search" />
			<span class="search-icon"></span>
			<button class="search-submit" type="submit" id="searchsubmit<?= '-' . $classes ?>"></button>
		</div>
	</form>
</div>