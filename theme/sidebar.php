<?php
if (!is_active_sidebar('sidebar-filters'));
?>

<ul id="sidebar-filters" class="sidebar-filters">
	<li class="filters-title">Фильтры</li>

	<?php dynamic_sidebar('sidebar-filters'); ?>

</ul>