<?php get_header(); ?>
<main>
	<section class="block">

		<?php get_template_part('/php/templates/breadcrumbs'); ?>

		<div class="page__tpl container">
			
			<h1 class="block__title"><?= get_the_title() ?></h1>

			<?php if (have_posts()) { ?>
				<?php while (have_posts()) { ?>
					<?php the_post(); ?>
					<?php the_content(); ?>
				<?php } ?>
			<?php } ?>

		</div>
	</section>

	<?php get_footer(); ?>