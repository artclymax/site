<?php get_header() ?>

<main class="page checkout-page">

	<?php include get_template_directory() . '/php/templates/breadcrumbs.php'; ?>

	<section class="block checkout">
		<div class="container">

			<?php
			$request_uri = $_SERVER['REQUEST_URI'];

			if (strpos($request_uri, 'order-received') !== false) {
			?>

				<h1 class="block__title">Заказ оформлен</h1>

				<div class="order__received">
					<div class="order__received--img">
						<img src="<?php bloginfo(
												'template_directory'
											); ?>/img/order-received.png" alt="">
					</div>
					<div class="order__received--content">
						<div class="order__received--content-title">Ваш заказ <span class="order__number">№<?= get_query_var('order-received') ?></span> поступил в обработку, в ближайшее время с Вами свяжется менеджер!</div>
						<div class="order__received--content-subtitle">При возникновении вопросов вы можете связаться с нами по телефонам:
							<div class="phones">
								<?php if ($phone_1 = get_option('phone_1')) { ?>
									<div class="phone">
										<a href="tel:<?= $phone_1 ?>"><?= $phone_1 ?></a>
									</div>
								<?php } ?>
								<?php if ($phone_2 = get_option('phone_2')) { ?>
									<div class="phone">
										<a href="tel:<?= $phone_2 ?>"><?= $phone_2 ?></a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<h1 class="block__title"><?= get_the_title(); ?></h1>

				<?php do_action('woocommerce_before_checkout_form'); ?>

				<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__('Checkout', 'woocommerce'); ?>">
					<div class="row">
						<div class="col col-8 col-sm">
							<div class="checkout__client_data--wrapper">
								<?php do_action('woocommerce_checkout_before_customer_details'); ?>

								<div class="col2-set" id="customer_details">

									<?php do_action('woocommerce_checkout_billing'); ?>

									<?php do_action('woocommerce_checkout_shipping'); ?>

								</div>

								<?php do_action('woocommerce_checkout_after_customer_details'); ?>

							</div>
						</div><!-- .col-8-->


						<div class="col col-4 col-sm">
							<div class="checkout__review_order">
								<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

								<!-- <h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3> -->

								<?php do_action('woocommerce_checkout_before_order_review'); ?>

								<div id="order_review" class="woocommerce-checkout-review-order">
									<?php do_action('woocommerce_checkout_order_review'); ?>
								</div>

								<?php do_action('woocommerce_checkout_after_order_review'); ?>

							</div>

						</div><!-- .col-4-->

					</div> <!-- .row-->
				</form>


			<?php } ?>


		</div>
	</section>

	<?php get_footer();
