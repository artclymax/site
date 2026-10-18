<?php get_header();

$about = get_field('about');

?>

<main class="page page-o_kompanii">


	<section class="block o_kompanii">
		<?php get_template_part('/php/templates/breadcrumbs'); ?>
		<div class="container">
			<h1 class="block__title"><?= get_the_title() ?></h1>


			<div class="o_kompanii__content">


				<?php if (!empty($about)) { ?>
					<?php foreach ($about as $key => $item) { ?>
						<div class="row <?= $key % 2 == 0 ? '' : 'reverse' ?>">
							<div class="col col-6 col-sm-12">
								<?= wpautop($item['content']) ?>
							</div>
							<div class="col col-6 col-sm-12">
								<?= wp_get_attachment_image($item['img'], "full", false, ['class' => 'o-kompanii__img', 'alt' => 'img']) ?>
							</div>
						</div>
					<?php } ?>
				<?php } ?>

			</div>

		</div>
	</section>

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


	<?php
	$licenzii = get_field('licenzii');

	if (!empty($licenzii)) { ?>

		<section class="block docs">
			<div class="container">

				<div class="block__title"><?= esc_html(get_field('about_docs_title') ?? ''); ?></div>

				<div class="o-kompanii__swiper swiper">
					<div class="swiper-wrapper">

						<?php foreach ($licenzii as $item) { ?>
							<div class="o-kompanii__swiper-slide swiper-slide">

								<a class=" swiper-slide-img" data-fancybox="gallery-docs" href="<?= esc_attr(wp_get_attachment_image_src($item['img'], "full")[0]) ?> ">
									<?php echo wp_get_attachment_image($item['img'], "full", false, [
										"class" => "o-kompanii__img",
										"alt" => "img",
									]) ?>
								</a>

								<p class="title"><?= esc_html($item['title']) ?></p>
							</div>
						<?php } ?>
					</div>

					<div class=" navigation">
						<div class="swiper-button-prev button-prev"></div>
						<div class="swiper-button-next button-next"></div>
					</div>

					<!-- <div class=" o-kompanii__swiper-pagination swiper-pagination"></div> -->
				</div>

			</div>
		</section>

	<?php } ?>

	<?php get_footer('form'); ?>