<?php
/*
Template Name: Policy
*/
?>

<?php get_header(); ?>

<main class="page page__policy">

	<?php get_template_part('/php/templates/breadcrumbs'); ?>

	<section class="block policy">
		<div class="container">

			<h1 class="block__title"><?= the_title() ?></h1>


			<div class="page__policy--content">
				<?= the_content() ?>
			</div>


		</div>
	</section>


	<?php get_footer();