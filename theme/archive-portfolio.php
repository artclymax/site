<?php get_header(); ?>

<main class="archive-page archive-page-portfolio">
	<section class="block">
		<?php include get_template_directory() . '/php/templates/breadcrumbs.php'; ?>
		<div class="container">

			<h1 class="block__title">Портфолио</h1>

			<?php if (have_posts()) { ?>

				<div class="row">
					<?php while (have_posts()) {
						the_post();
					?>

						<a class="col col-4 col-sm-6 col-xs" href="<?= get_the_post_thumbnail_url() ?>" data-fancybox="gallery-portfolio">
							<?= get_the_post_thumbnail() ?>
						</a>

					<?php } ?>
				</div>

				<?php
				set_query_var('custom_query', $loop ?? '');
				get_template_part('php/templates/pagination');
				?>


			<?php	} else { ?>

				<div class="inform_message">Фотографии скоро будут добавлены</div>

			<?php } ?>


		</div>
	</section>

	<?php get_footer('form');
