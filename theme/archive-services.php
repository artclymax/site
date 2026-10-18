<?php get_header(); ?>

<main class="archive-page archive-page-services">
	<section class="block">
		<?php include get_template_directory() . '/php/templates/breadcrumbs.php'; ?>
		<div class="container">

			<h1 class="block__title">Услуги</h1>

			<?php if (have_posts()) { ?>

				<div class="row">
					<?php while (have_posts()) {
						the_post(); ?>

						<div class="col col-4 col-sm-6 col-xs">

							<div class="services__card">
								<div class="services__card--container">
									<?= get_the_post_thumbnail($post->ID, 'full', ['alt' => get_the_title(), 'loading' => 'lazy', 'class' => 'services__card--img']) ?>
									<div class="services__card--bottom">
										<div class="title">
											<?= get_the_title() ?>
										</div>
									</div>
								</div>
							</div>

						</div>

					<?php } ?>
				</div>

				<?php
				set_query_var('custom_query', $loop ?? '');
				get_template_part('php/templates/pagination');
				?>

			<?php	} else { ?>

				<div class="inform_message">Услуги скоро появятся</div>

			<?php } ?>

		</div>
	</section>

	<section class="description">
		<div class="container">
			<?php echo wp_kses_post(get_field('services_content', 'options')) ?>
		</div>
	</section>

	<?php get_footer();
