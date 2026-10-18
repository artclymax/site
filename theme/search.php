<?php get_header(); ?>
<main class="search-page">
	<section class="block search_result">

		<div class="breadcrumbs">
			<div class="container">

				<ul itemscope itemtype="http://schema.org/BreadcrumbList">
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a href="<?php echo home_url(); ?>" itemprop="item">
							<span itemprop="name">Главная</span>
						</a>
						<meta itemprop="position" content="1" />
					</li>
					&nbsp;/&nbsp;
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<span class="active" itemprop="name">Результаты поиска</span>
						<meta itemprop="position" content="3" />
					</li>
				</ul>

			</div>
		</div>

		<div class="container">
			<h1 class="block__title"><?php printf('Результаты поиска для: %s', '<span>' . get_search_query() . '</span>'); ?></h1>

			<?php
			$search_query = get_search_query();

			$args = array(
				'post_type' => 'product',
				's' => $search_query,
				'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
			);

			$loop = new WP_Query($args);

			if ($loop->have_posts()) { ?>
				<div class="products row">
					<?php while ($loop->have_posts()) : $loop->the_post();
						wc_get_template_part('content', 'product');
					endwhile; ?>

				</div>
				<?php
				set_query_var('custom_query', $loop);
				get_template_part('php/templates/pagination');
				?>

			<?php } else { ?>
				<div>
					<h2>Ничего не найдено</h2>
					<p>Попробуйте ввести другие ключевые слова.</p>
				</div>
			<?php }

			wp_reset_postdata();
			?>


		</div>
	</section>


	<?php get_footer(); ?>