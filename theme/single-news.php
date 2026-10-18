<?php get_header() ?>

<main class="single single__news">

	<section class="block ">
		<?php get_template_part('/php/templates/breadcrumbs', null, ['page_slug' => $post->post_type]); ?>

		<div class="container">

			<h1 class="block__title"><?= get_the_title(); ?></h1>

			<div class="single__news--date"><?= get_the_date() ?></div>

			<div class="single__news--excerpt"><?= get_the_excerpt() ?></div>

			<?php $imgs = get_field('news') ?>
			<div class="row">
				<?php foreach ($imgs as $img) { ?>
					<div class="col col-6 col-sm-12">
						<?= wp_get_attachment_image($img, 'full', false, ['class' => 'single__news--img', 'alt' => get_the_title(), 'loading' => 'lazy']) ?>
					</div>
				<?php } ?>
			</div>

			<div class="single__news--content">
				<?php the_content() ?>
			</div>

		</div>
	</section>

	<?php get_template_part('php/templates/steps-tpl') ?>

	<?php get_footer();
