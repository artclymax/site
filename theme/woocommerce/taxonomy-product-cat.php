<?php get_header(); ?>

<?php
$current_category = get_queried_object();
?>

<main class="product-cat-page">
	<section class="block product_cat">
		<?php woocommerce_breadcrumb();; ?>

		<div class="container">
			<div class="block__title"><?= $current_category->name ?></div>

			<div class="row">
				<div class="col col-3 d-none--md">
					<?php
					if (!wp_is_mobile()) {
						get_sidebar('filter-sidebar');
					}
					?>
				</div>

				<div class="col col-9 col-md-12">
					<div>
						<?php
						if (wp_is_mobile()) {
							get_sidebar('filter-sidebar');
						}
						?>

						<?= woocommerce_catalog_ordering(); ?>

						<?php
						do_action('woocommerce_before_shop_loop');

						woocommerce_product_loop_start();

						if (wc_get_loop_prop('total')) {
							while (have_posts()) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 */
								do_action('woocommerce_shop_loop');

								wc_get_template_part('content', 'product');
							}
						} else {
							echo '<div class="col col-12">
							<div class="not_exist_product">Товаров в категории <span class="not_exist_product--cat">' . $current_category->name . '</span> пока нет, но они скоро появятся!</div>
							</div>';
						}

						woocommerce_product_loop_end();

						/**
						 * Hook: woocommerce_after_shop_loop.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action('woocommerce_after_shop_loop');

						?>

					</div>

					<?php
					$category_id = $current_category->parent ? $current_category->parent : $current_category->term_id;
					$content = get_field('description', 'category_' . $category_id);

					if ($content) { ?>
						<section class="block product_cat__parent_cat_description">
							<div class="product_cat__parent_cat_description--content">
								<?= wp_kses_post($content) ?>
							</div>
						</section>
					<?php  } ?>

					<?php
					$featured_products = wc_get_products(array(
						'limit' => 8,
						'featured' => true,
						'orderby' => 'ASC',
					));

					if (!empty($featured_products)) {
					?>
						<section class="block">
							<div class="block__title">Популярные товары</div>

							<?php
							echo do_shortcode('[featured_products limit="3"]');
							?>

						</section>
					<?php  } ?>
				</div>
			</div>
		</div>
	</section>



	<?php get_footer();
