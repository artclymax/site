<?php get_header() ?>

<main class="single single-<?= $post->post_type; ?>">

	<section class="block ">
		<?php get_template_part('/php/templates/breadcrumbs', null, ['page_slug' => $post->post_type]); ?>

		<div class="container">

			<h1 class="block__title"><?= get_the_title(); ?></h1>

			<div class="content"><?php the_content() ?></div>

			<div class="row">
				<?php
				$gallery = get_field('gallery', $post->ID);

				if (!empty($gallery)) {
					foreach ($gallery as $img) {
						$img_url = $img['metadata']['full']['file_url'];

				?>
						<div class="col col-6 col-xs">
							<img class="" src="<?= $img_url ?>" alt="<?= get_the_title(); ?>" loading="lazy">
						</div>
					<?php }
				} else { ?>
					<div class="col col-6 col-xs">
						<img class="" src="<?= get_the_post_thumbnail_url() ?>" alt="<?= get_the_title(); ?>" loading="lazy">
					</div>
				<?php } ?>

			</div>



		</div>
	</section>

	<?php get_footer();
