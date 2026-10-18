<?php get_header() ?>

<main class="single single__services">

	<section class="block ">
		<?php get_template_part('/php/templates/breadcrumbs', null, ['page_slug' => $post->post_type]); ?>

		<div class="container">

			<h1 class="block__title"><?= get_the_title(); ?></h1>

			<div class="row">
				<?php if ($content_1 = get_field('content_1')) { ?>
					<div class="col col-12">
						<div class="single__services--content"><?= wp_kses_post($content_1) ?></div>
					</div>
				<?php } ?>

				<?php if ($content_2 = get_field('content_2')) { ?>
					<div class="col col-6 col-sm-12">
						<div class="single__services--content"><?= wp_kses_post($content_2) ?></div>
					</div>
				<?php } ?>

				<div class="col col-6 col-sm-12">
					<?= get_the_post_thumbnail($post->ID, 'full', ['class' => 'single__services--img', 'alt' => get_the_title(), 'loading' => 'lazy']) ?>
				</div>

			</div>

		</div>
	</section>

	<?php get_template_part('php/templates/steps-tpl') ?>

	<?php get_footer('form');
