<?php get_header() ?>

<main class="page cart-page">

	<?php include get_template_directory() . '/php/templates/breadcrumbs.php'; ?>

	<section class="block cart">
		<div class="container">

			<h1 class="block__title"><?= get_the_title(); ?></h1>

			<?php do_action('woocommerce_before_cart'); ?>

			<?php if (empty(WC()->cart->get_cart())) { ?>
				<div class="cart-page__empty_cart">
					<div>Ваша корзина пока пуста</div>
					<a href="<?= site_url() ?>">Вернуться на главную</a>
				</div>
			<?php } ?>

			<div class="row">
				<div class="col col-8 col-sm">
					<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

						<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents d-none" cellspacing="0">

							<tbody>
								<?php do_action('woocommerce_before_cart_contents'); ?>

								<?php
								foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
									$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
									$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
									/**
									 * Filter the product name.
									 *
									 * @since 2.1.0
									 * @param string $product_name Name of the product in the cart.
									 * @param array $cart_item The product in the cart.
									 * @param string $cart_item_key Key for the product in the cart.
									 */
									$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

									if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
										$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
								?>
										<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

											<div class="cart-page__item">
												<div class="cart-page__img_title">
													<div class="product-thumbnail cart-page__img_title--img">
														<?php
														$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
														$img_url = wp_get_attachment_url($_product->get_image_id());
														if (! $product_permalink) { ?>
															<img src="<?= $img_url ?>" alt="">
														<?php	} else {
															printf('<a href="%s"><img src="%s" alt=""></a>', esc_url($product_permalink), $img_url);
														}
														?>
													</div>
													<div class="product-name cart-page__img_title--title" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
														<?php
														if (! $product_permalink) {
															echo wp_kses_post($product_name . '&nbsp;');
														} else {
															/**
															 * This filter is documented above.
															 *
															 * @since 2.1.0
															 */
															echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));

															echo '<div class="product__sku">Код товара: ' . $_product->get_sku() . '</div>';
														}

														do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

														// Meta data.
														echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

														// Backorder notification.
														if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
															echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
														}
														?></div>
												</div>
												<div class="cart-page__quantity_wrapper">
													<div class="cart-page__quantity_wrapper--quantity">
														<div class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
															<?php
															if ($_product->is_sold_individually()) {
																$min_quantity = 1;
																$max_quantity = 1;
															} else {
																$min_quantity = 0;
																$max_quantity = $_product->get_max_purchase_quantity();
															}

															$product_quantity = woocommerce_quantity_input(
																array(
																	'input_name'   => "cart[{$cart_item_key}][qty]",
																	'input_value'  => $cart_item['quantity'],
																	'max_value'    => $max_quantity,
																	'min_value'    => $min_quantity,
																	'product_name' => $product_name,
																),
																$_product,
																false
															);

															echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
															?>
														</div>
														<div class="product-remove">
															<?php
															echo apply_filters(
																'woocommerce_cart_item_remove_link',
																sprintf(
																	'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
																	<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M11 11L21 21M11 11L1 1M11 11L1 21M11 11L21 1" stroke="#333333" stroke-linecap="round"/>
																	</svg>
																	</a>',
																	esc_url(wc_get_cart_remove_url($cart_item_key)),
																	/* translators: %s is the product name */
																	esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
																	esc_attr($product_id),
																	esc_attr($_product->get_sku())
																),
																$cart_item_key
															);
															?>
														</div>
													</div>
													<div class="cart-page__price_wrapper">
														<div class="product-price cart-page__price_wrapper--price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
															<?php
															$regular_price = $_product->get_regular_price();
															$sale_price = $_product->get_sale_price();

															echo $sale_price ? $sale_price . ' BYN' : $regular_price . ' BYN';
															?>
														</div>
														<?php

														if ($sale_price) { ?>
															<div class="cart-page__price_wrapper--regular_price">
																<del><?= $regular_price ?> BYN</del>
															</div>
														<?php } ?>
														<div class="cart-page__price_wrapper--remove_btn">
															<?php
															echo apply_filters(
																'woocommerce_cart_item_remove_link',
																sprintf(
																	'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&#215; Удалить</a>',
																	esc_url(wc_get_cart_remove_url($cart_item_key)),
																	/* translators: %s is the product name */
																	esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
																	esc_attr($product_id),
																	esc_attr($_product->get_sku())
																),
																$cart_item_key
															);
															?>
														</div>
													</div>
												</div>
											</div>

										</tr>
								<?php
									}
								}
								?>

								<?php do_action('woocommerce_cart_contents'); ?>

								<?php if (!empty(WC()->cart->get_cart())) { ?>
									<tr>
										<td colspan="6" class="actions cart-page__update_cart">

											<button type="submit" class="btn cmn-btn cmn-btn--main button update_cart_btn d-none <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

											<?php do_action('woocommerce_cart_actions'); ?>

											<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
										</td>
									</tr>
								<?php } ?>

								<?php do_action('woocommerce_after_cart_contents'); ?>
							</tbody>
						</table>
					</form>
				</div>

				<div class="col col-4 col-sm">
					<div class="cart-page__result">
						<?php do_action('woocommerce_before_cart_collaterals'); ?>

						<?php do_action('woocommerce_cart_collaterals'); ?>

					</div>
				</div>
			</div>

			<?php do_action('woocommerce_after_cart'); ?>
		</div>
	</section>

	<?php get_footer('form') ?>