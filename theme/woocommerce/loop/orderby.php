<div class="sort-product-filters">
	<?php if (wp_is_mobile()) { ?>
		<form class="woocommerce-ordering" method="get">
			<span>Сортировать: </span>
			<select name="orderby" class="orderby" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>">
				<?php foreach ($catalog_orderby_options as $id => $name) : ?>
					<option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
				<?php endforeach; ?>
			</select>
			<input type="hidden" name="paged" value="1" />
			<?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
		</form>
	<?php } else { ?>
		<?php if (is_product_category() || is_product_tag()) {
			$orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : '';

			echo '<div class="sort-product-filters--full">';
			echo '<span>Сортировать: </span>';
			echo '<a href="' . esc_url(add_query_arg('orderby', 'popularity')) . '" class="button ' . ($orderby === 'popularity' ? 'active' : '') . '">' . 'По популярности' . '</a>';
			echo '<a href="' . esc_url(add_query_arg('orderby', 'price-desc')) . '" class="button ' . ($orderby === 'price-desc' ? 'active' : '') . '">' . 'По убыванию цены' . '</a>';
			echo '<a href="' . esc_url(add_query_arg('orderby', 'price')) . '" class="button ' . ($orderby === 'price' ? 'active' : '') . '">' . 'По возрастанию цены' . '</a>';
			echo '<a href="' . esc_url(add_query_arg('orderby', 'date')) . '" class="button ' . ($orderby === 'date' ? 'active' : '') . '">' . 'По новизне' . '</a>';
			echo '</div>';
		}
		?>
	<?php } ?>


	<form method="get" class="products-per-page">
		<select name="products_per_page" onchange="this.form.submit()">
			<option value="12" <?php selected(12, isset($_GET['products_per_page']) ? intval($_GET['products_per_page']) : get_option('posts_per_page')); ?>>12</option>
			<option value="24" <?php selected(24, isset($_GET['products_per_page']) ? intval($_GET['products_per_page']) : get_option('posts_per_page')); ?>>24</option>
			<option value="36" <?php selected(36, isset($_GET['products_per_page']) ? intval($_GET['products_per_page']) : get_option('posts_per_page')); ?>>36</option>
			<option value="48" <?php selected(48, isset($_GET['products_per_page']) ? intval($_GET['products_per_page']) : get_option('posts_per_page')); ?>>48</option>
		</select>
	</form>
</div>