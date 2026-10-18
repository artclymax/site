<?php get_header(); ?>
<main class="home-page">

	<?php $hero = get_field('hero'); ?>
	<section class="block hero">
		<picture>
			<source srcset="<?php echo $hero['mobile_img']; ?> 1x" media="(max-width: 768px)" type="image/webp">
			<img src="<?= $hero['full_img']; ?>" alt="Hero Image" fetchpriority="high" loading="eager" class="hero__img">
		</picture>

		<div class="container">

			<div class="hero__content">
				<?= wp_kses_post(wpautop($hero['content'])) ?>

				<?php if ($hero['btn_text'] && $hero['btn_link']) { ?>
					<a href="<?= esc_html($hero['btn_link']); ?>"
						class="cmn-btn cmn-btn--main"><?= esc_html($hero['btn_text']); ?></a>
				<?php } ?>
			</div>

		</div>


	</section>

	<section class="block categories">
		<div class="container">
			<?php
			$product_categories = get_terms([
				'taxonomy' => 'product_cat',
				'hide_empty' => false,
				'exclude' => [15],
				'parent' => 0
			]);
			?>

			<div class="block__title">Наша климатическая техника</div>

			<?php if (!empty($product_categories) && !is_wp_error($product_categories)) { ?>
				<div class="row">

					<?php foreach ($product_categories as $category) {
						$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);

						$child_cats = get_terms([
							'taxonomy' => 'product_cat',
							'hide_empty' => false,
							'parent' => $category->term_id
						]);

						?>

						<div class="col col-3 col-sm-6 col-xs">
							<a href="<?= get_term_link($category->slug, 'product_cat') ?>" class="category__card">
								<?php if ($thumbnail_id) { ?>
									<?= wp_get_attachment_image($thumbnail_id, 'full', false, ['class' => 'category__card--img', 'alt' => $category->name, 'loading' => 'lazy']) ?>
								<?php } else { ?>
									<img src="<?= get_template_directory_uri() . '/img/no-img.png' ?>" width="150" height="140" alt="no-img">
								<?php } ?>


								<div class="category__card--title"><?= $category->name ?></div>

							</a>
						</div>

					<?php } ?>

				</div>
			<?php } ?>
		</div>
	</section>

	<?php
	$featured_products = wc_get_products(array(
		'limit' => 8,
		'featured' => true,
	));

	if (!empty($featured_products)) {
		?>
		<section class="block popular">
			<div class="container">
				<div class="block__title">Популярные товары</div>

				<?php
				echo do_shortcode('[featured_products limit="8"]');
				?>

			</div>
		</section>
	<?php } ?>

	<?php
	$banner = get_field('banner');
	?>
	<section class="block banner">
		<div class="container">
			<div class="banner__wrapper">
				<div class="banner__content">
					<?= wp_kses_post(wpautop($banner['content'])) ?>

					<a href="<?= esc_html($banner['btn_link']); ?>"
						class="cmn-btn cmn-btn--main"><?= esc_html($banner['btn_text']); ?></a>
				</div>
				<?= wp_get_attachment_image($banner['img_1'], 'full', false, ['class' => 'banner__img img_1', 'alt' => 'img', 'loading' => 'lazy']) ?>
				<?= wp_get_attachment_image($banner['img_2'], 'full', false, ['class' => 'banner__img img_2', 'alt' => 'img', 'loading' => 'lazy']) ?>
			</div>
		</div>
	</section>
	<?php
	$reviews = get_field('reviews');
	$args = [
		'post_type' => 'review',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_status' => 'publish'
	];

	$query = new WP_Query($args);
	?>
	<?php if ($query->have_posts()): ?>
		<section class="block reviews-mx">
			<div class="container">
				<h2 class="block__title"><?= esc_html($reviews['title']); ?></h2>
				<div class="row">
					<div class="col col-4">
						<?= wp_kses_post($reviews['descr']); ?>
					</div>
				</div>
				<div class="reviews__wrapper">
					<div class="reviews__form-box">
						<h3 class="reviews__form-title"><?= esc_html($reviews['form_title']); ?></h3>
						<div class="reviews__form">
							<?php echo do_shortcode('[contact-form-7 id="c0296eb" title="Форма отзывов"]') ?>
						</div>
					</div>
					<div class="swiper mx-reviews-swiper">
						<div class="swiper-wrapper mx-reviews-swiper__wrapper">
							<?php
							while ($query->have_posts()):
								$query->the_post();
								?>
								<div class="swiper-slide mx-reviews-slide">
									<div class="mx-reviews-slide__wrapper">
										<?php if (!empty(has_post_thumbnail())): ?>
											<a class="mx-reviews-slide__image image-box" data-fancybox href="<?php the_post_thumbnail_url() ?>"
												target="_blank">
												<?php the_post_thumbnail() ?>
											</a>
										<?php else: ?>
											<div class="mx-reviews-slide__content">
												<div class="mx-reviews-slide__descr descr">
													<?php the_content() ?>
												</div>
												<div class="mx-reviews-slide__bottom">
													<div class="mx-reviews-slide__meta">
														<h3 class="mx-reviews-slide__title">
															<?php the_title() ?>
														</h3>
														<?php if (!empty($rating = get_field('review_rating'))): ?>
															<div class="mx-reviews-slide__rating" aria-label="Оценка <?= esc_attr($rating) ?>">
																<?php while ($rating): ?>
																	<div class="review_rating__icon">
																		<img src="<?= get_template_directory_uri() . '/img/star-full.svg' ?>">
																	</div>
																	<?php $rating--; endwhile; ?>
															</div>
														<?php endif; ?>
													</div>
													<p class="mx-reviews-slide__origin">
														Отзыв с сайта
													</p>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
								<?php
							endwhile;
							wp_reset_postdata(); ?>
						</div>
						<button class="swiper-btn swiper-btn__prev mx-reviews-swiper__btn mx-reviews-swiper__btn-prev" type="button"
							aria-label="Назад">
							<svg width="13" height="24" viewBox="0 0 13 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M0.265141 12.2732L11.0279 23.0061C11.3805 23.3575 11.9514 23.3569 12.3035 23.0043C12.6552 22.6517 12.6543 22.0804 12.3016 21.7287L2.17952 11.6346L12.302 1.54051C12.6546 1.18872 12.6555 0.617862 12.3038 0.265185C12.1273 0.088381 11.8962 0 11.6649 0C11.4344 0 11.204 0.087789 11.0279 0.263366L0.265141 10.996C0.0953182 11.165 0 11.395 0 11.6346C0 11.8742 0.095572 12.1039 0.265141 12.2732Z"
									fill="#0560D8" />
							</svg>
						</button>
						<button class="swiper-btn swiper-btn__next mx-reviews-swiper__btn mx-reviews-swiper__btn-next" type="button"
							aria-label="Вперёд">
							<svg width="13" height="24" viewBox="0 0 13 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M12.3019 10.996L1.53915 0.263139C1.18652 -0.0883111 0.615616 -0.0877191 0.263573 0.264958C-0.0881729 0.61755 -0.0872848 1.18879 0.265392 1.54053L10.3875 11.6346L0.265053 21.7287C-0.0875814 22.0805 -0.0885118 22.6514 0.263234 23.004C0.4397 23.1808 0.670868 23.2692 0.90208 23.2692C1.13266 23.2692 1.36294 23.1814 1.53911 23.0058L12.3019 12.2732C12.4717 12.1042 12.567 11.8742 12.567 11.6346C12.567 11.3951 12.4715 11.1654 12.3019 10.996Z"
									fill="#0560D8" />
							</svg>
						</button>
						<div class="swiper-pagination mx-reviews-swiper__pagination"></div>
					</div>

				</div>
		</section>
	<?php endif; ?>
	<?php $brands = get_field('brands');
	if (!empty($brands)) { ?>
		<section class="block brands">
			<div class="container">
				<h2 class="block__title">Бренды, с которыми мы работаем</h2>

				<div class="brands__swiper swiper">
					<div class="swiper-wrapper">

						<?php foreach ($brands as $item) { ?>
							<div class="brands__swiper--slide swiper-slide">
								<?php echo wp_get_attachment_image($item, "full", false, [
									"alt" => "img",
									"loading" => "lazy",
								]); ?>
							</div>
						<?php } ?>
					</div>

					<div class="brands__navigation navigation">
						<div class="swiper-button-prev brands__button-prev"></div>
						<div class="swiper-button-next brands__button-next"></div>
					</div>

				</div>
			</div>
		</section>
	<?php } ?>

	<?php get_footer('form'); ?>