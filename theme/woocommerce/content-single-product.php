<?php

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('content-single-product', $product); ?>>
	<div class="content-single-product--container">
		<div class="row">
			<div class="col col-6 col-sm">
				<?php
				$main_img_id = $product->get_image_id();
				$images_id = $product->get_gallery_image_ids();
				array_unshift($images_id, $main_img_id);
				?>

				<div class="embla">
					<div class="embla__viewport">
						<div class="embla__container">

							<?php
							foreach ($images_id as $image_id) {
								$url_img = wp_get_attachment_url($image_id);

								if (!$url_img) {
									$url_img = get_template_directory_uri() . '/img/no-img.png';
								}
							?>

								<div class="embla__slide">
									<div class="embla__slide__number">
										<img data-embla-open="embla-modal" class="thumbnail thumbnail-product" src="<?= $url_img ?>" data-large="<?= $url_img ?>" alt="" loading='lazy'>
									</div>
								</div>

							<?php } ?>

						</div>
					</div>


					<div class="embla-thumbs">
						<div class="embla-thumbs__viewport">
							<div class="embla-thumbs__container">

								<?php
								if (count($images_id) > 1) {
									foreach ($images_id as $image_id) {
										$url_img = wp_get_attachment_url($image_id);
								?>

										<div class="embla-thumbs__slide embla-thumbs__slide--selected">
											<button type="button" class="embla-thumbs__slide__number">
												<img src="<?= $url_img ?>" alt="">
											</button>
										</div>

								<?php }
								} ?>

							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col col-6 col-sm">
				<div class="content-single-product--content">
					<?php if ($sku = $product->get_sku()) { ?>
						<div class="article">Код товара: <?= $sku ?></div>
					<?php } ?>

					<div class="characteristics">
						<div class="characteristics__title">
							Основные характеристики:
						</div>
						<ul class="characteristics__items">

							<?php
							$attributes = $product->get_attributes();
							if (! empty($attributes)) {
								$i = 0;
								foreach ($attributes as $key => $attribute) {
									if ($i > 5) break;

									$attribute_name = $attribute->get_name();
									$attribute_values = $attribute->get_options();
							?>
									<li class="characteristics__item">
										<spn class="name">
											<?= wc_attribute_label($attribute_name) ?>
										</spn>
										<span class="value">
											<?php foreach ($attribute_values as $value) { ?>
												<span>
													<?= esc_html($value) ?>
												</span>
											<?php } ?>
										</span>
									</li>
							<?php
									$i++;
								}
							}
							?>
						</ul>
						<a href="#all-characteristics" class="characteristics__all">Все характеристики</a>
					</div>

					<div class="content-single-product--content-btns">
						<?php if ($product->get_regular_price()) { ?>
							<span class="price">
								<span class="price--on_sale"><?= number_format($product->get_price(), 0, '', ' ') ?> BYN</span>
								<?php if ($product->is_on_sale()) { ?>
									<span class="price--regular"><?= number_format($product->get_regular_price(), 0, '', ' ') ?> BYN</span>
								<?php } ?>
							</span>
						<?php } ?>
						<form class="cart" action="<?= get_permalink() ?>" method="post" enctype="multipart/form-data">
							<div class="quantity">
								<label class="screen-reader-text" for="quantity_681f0f1a274bb"><?= get_the_title() ?></label>
								<input type="hidden" id="quantity_681f0f1a274bb" class="input-text qty text" name="quantity" value="1" aria-label="Количество товара" min="1" max="" step="1" placeholder="" inputmode="numeric" autocomplete="off">
							</div>
							<button type="submit" name="add-to-cart" value="<?= $product->get_id() ?> " class="single_add_to_cart_button button alt cmn-btn cmn-btn--main ">Добавить в корзину</button>
						</form>
					</div>

				</div>
				<!-- end .content-single-product--content -->
			</div>
		</div>
		<!-- end row-->

		<div class="content-single-product--information">
			<div class="title">Информация о товаре</div>

			<div class="row">
				<div class="col col-8 col-sm-12">
					<div class="subtitle">Описание товара</div>
					<div class="description">
						<?= wp_kses_post(wpautop($product->get_description())) ?>
					</div>

					<div class="characteristics">
						<div id="all-characteristics" class="characteristics__title">
							Основные характеристики:
						</div>
						<ul class="characteristics__items">

							<?php
							$attributes = $product->get_attributes();
							if (! empty($attributes)) {
								foreach ($attributes as $key => $attribute) {

									$attribute_name = $attribute->get_name();
									$attribute_values = $attribute->get_options();
							?>
									<li class="characteristics__item">
										<spn class="name">
											<?= wc_attribute_label($attribute_name) ?>
										</spn>
										<span class="value">
											<?php foreach ($attribute_values as $value) { ?>
												<span>
													<?= esc_html($value) ?>
												</span>
											<?php } ?>
										</span>
									</li>
							<?php
								}
							}
							?>
						</ul>
					</div>
				</div>
				<div class="col col-4 col-sm-12">
					<div class="subtitle">Инструкции</div>

					<div class="instructions row">

						<?php
						$instructions = get_field('instructions');
						foreach ($instructions as $instruction) {
							$url = $instruction['link'];
							$title = $instruction['title'];

							if ($url && $title) {
						?>

								<div class="col col-6">
									<a href="<?= esc_url($url) ?>" class="instruction" target="_blank">
										<img src="<?= get_template_directory_uri() ?>/img/instruction.png" alt="<?= $title ?>">
										<?= $title ?>
									</a>
								</div>

						<?php 	}
						} ?>
					</div>
				</div>
			</div>
		</div>
		<!-- end .content-single-product--information-->

	</div>
	<!-- end .content-single-product--container -->

	<?php
	$related_products = wc_get_related_products(get_the_ID(), 4);

	if (!empty($related_products)) { ?>
		<section class="block cross_sell_products">
			<div class="block__title">Рекомендуемые товары</div>
			<div class="row">
				<?php

				foreach ($related_products as $related_product_id) {
					$related_product = wc_get_product($related_product_id); ?>
					<div class="col col-3 col-sm-6">
						<div class="product__card">
							<div class="product__card--img">
								<a href="<?= $related_product->get_permalink() ?>">
									<?php if ($related_product->is_on_sale()) { ?>
										<span class="onsale">Акция</span>
									<?php } ?>
									<img src="<?= wp_get_attachment_url($related_product->get_image_id()) ?>" srcset="<?= wp_get_attachment_image_srcset($related_product->get_image_id()) ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="<?= esc_attr($related_product->get_name()) ?>" loading="lazy">
								</a>
							</div>
							<!-- end .product__card--img -->
							<div class="product__card--content">
								<div class="product__card--title"><a href="<?= $related_product->get_permalink() ?>"><?= $related_product->get_name() ?></a></div>

								<div>
									<p><span>Код товара: </span><span><?= $product->get_sku() ?></span></p>
								</div>

								<div class="product__card--footer">
									<span class="price">
										<span class="price--on_sale"><?= $related_product->get_price() ?> BYN</span>
										<?php if ($related_product->is_on_sale()) { ?>
											<span class="price--regular"><?= $related_product->get_regular_price() ?> BYN</span>
										<?php } ?>
									</span>
									<div class="product__card--footer-btns">
										<a href="<?= $related_product->get_permalink() ?>" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_<?= $related_product->get_id() ?>" data-quantity="1" class="button product_type_simple btn cmn-btn cmn-btn--main  cmn-btn--full <?= $related_product->is_in_stock() ? 'add_to_cart_button ajax_add_to_cart ' : '' ?>" data-product_id="<?= $related_product->get_id() ?>" data-product_sku="" aria-label="<?= $related_product->get_name() ?>" rel="nofollow" data-success_message=""><?= $related_product->is_in_stock() ? 'В корзину' : 'Под заказ' ?></a>
										<span id="woocommerce_loop_add_to_cart_link_describedby_<?= $related_product->get_id() ?>" class="screen-reader-text"></span>
									</div>
								</div><!-- product__card--footer -->
							</div><!-- product__card--content -->
						</div>
					</div>
				<?php } ?>
			</div>
		</section>
	<?php  } ?>
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action('woocommerce_after_single_product_summary');
	?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>