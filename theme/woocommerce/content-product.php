<?php

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (! is_a($product, WC_Product::class) || ! $product->is_visible()) {
	return;
}

$col = 'col col-4 col-sm-6';

if (is_front_page() || is_search() || is_product()) {
	$col = 'col col-3 col-sm-6';
}
?>

<div <?php wc_product_class($col, $product); ?>>
	<div class="product__card">


		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action('woocommerce_before_shop_loop_item'); ?>

		<div class="product__card--img">
			<a href="<?= $product->get_permalink() ?>">

				<img src="<?= wp_get_attachment_url($product->get_image_id()) ?>" srcset="<?= wp_get_attachment_image_srcset($product->get_image_id()) ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="<?= esc_attr($product->get_name()) ?>" loading="lazy">

				<?php
				/**
				 * Hook: woocommerce_before_shop_loop_item_title.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action('woocommerce_before_shop_loop_item_title');
				?>

			</a>
		</div>
		<!-- end .product__card--img -->

		<div class="product__card--content">
			<?php
			/**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action('woocommerce_shop_loop_item_title'); ?>

			<div class="product__card--footer">

				<?php
				/**
				 * Hook: woocommerce_after_shop_loop_item_title.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action('woocommerce_after_shop_loop_item_title');
				?>

				<?php

				/**
				 * Hook: woocommerce_after_shop_loop_item.
				 *
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action('woocommerce_after_shop_loop_item');
				?>
			</div><!-- product__card--footer -->
		</div><!-- product__card--content -->
	</div><!--end product card -->
</div>