<?php

if (! defined('ABSPATH')) {
	exit;
}

global $product;

$aria_describedby = isset($args['aria-describedby_text']) ? sprintf('aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s"', esc_attr($product->get_id())) : '';
?>
<div class="product__card--footer-btns">
	<?php
	$btn_name = 'В корзину';

	if ($product->is_on_backorder() || !$product->is_in_stock()) {
		$btn_name = 'Под заказ';
	}

	echo apply_filters(
		'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
		sprintf(
			'<a href="%s" %s data-quantity="%s" class="%s" %s>%s</a>',
			esc_url($product->add_to_cart_url()),
			$aria_describedby,
			esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
			esc_attr(isset($args['class']) ? $args['class'] . '  btn cmn-btn cmn-btn--main cmn-btn--main-md cmn-btn--full' : 'button'),
			isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
			esc_html($btn_name)
		),
		$product,
		$args
	);
	?>
	<?php if (isset($args['aria-describedby_text'])) : ?>
		<span id="woocommerce_loop_add_to_cart_link_describedby_<?php echo esc_attr($product->get_id()); ?>" class="screen-reader-text">
			<?php echo esc_html($args['aria-describedby_text']); ?>
		</span>
	<?php endif; ?>
</div>