<?php

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header();
?>

<main>
	<section class="block">

	<?php
	if (function_exists('woocommerce_breadcrumb')) {
		woocommerce_breadcrumb();
	}
	?>

		<div class="container">

			<h1 class="block__title"><?= the_title() ?></h1>

			<?php
			/**
			 * woocommerce_before_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action('woocommerce_before_main_content');
			?>


			<?php while (have_posts()) : ?>
				<?php the_post(); ?>

				<?php wc_get_template_part('content', 'single-product'); ?>

			<?php endwhile; ?>

		</div> <!-- end container -->

	</section>
	<?php
	/**
	 * woocommerce_after_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action('woocommerce_after_main_content');
	?>

	<?php
	get_footer();
