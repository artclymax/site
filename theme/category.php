<?php get_header(); ?>

<?php
$category = get_queried_object();
?>

<main class="category-page">
	<section class="block">
		<?php include get_template_directory() . '/php/templates/breadcrumbs.php'; ?>

		<div class="container">
			<h1 class="block__title"><?= single_cat_title() ?></h1>


			<?php $args = array(
				'post_type' => 'services',
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $category->slug,
					),
				),
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) {
				echo '<div class="row">';
				while ($query->have_posts()) {
					$query->the_post();
					echo '<div class="col col-4 col-sm">
					<div class="card">
							<div class="card__img"><img src="' . get_the_post_thumbnail_url() . '" alt="' . get_the_title() . '"></div>
							<div class="card__title">' . get_the_title() . '</div>
							<div class="card__subtitle">' . get_the_excerpt() . '</div>
							<div class="card__btn">
									<a href="' . get_the_permalink() . '" class="cmn-btn cmn-btn--main cmn-btn--main-md grey">Подробнее</a>
							</div>
					</div>
			</div>';
				}
				echo '</div>';
			} else {
				echo 'Нет постов в этой категории.';
			}

			wp_reset_postdata(); ?>
		</div>

	</section>
	<?php get_footer(); ?>