	<div class="breadcrumbs">
		<div class="container">

			<?php if (is_single()) {
				$slug = $args['page_slug'];

			?>

				<ul itemscope itemtype="http://schema.org/BreadcrumbList">
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a href="<?php echo home_url(); ?>" itemprop="item">
							<span itemprop="name">Главная</span>
						</a>
						<meta itemprop="position" content="1" />
					</li>
					&nbsp;/&nbsp;
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a href="<?= get_post_type_archive_link($slug); ?>" itemprop="item">
							<span itemprop="name"><?= get_post_type_object($slug)->label ?></span>
						</a>
						<meta itemprop="position" content="1" />
					</li>
					&nbsp;/&nbsp;
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<span itemprop="name"><?php single_post_title(); ?></span>
						<meta itemprop="position" content="2" />
					</li>
				</ul>

			<?php } ?>

			<?php if (is_page() || is_archive() || is_category()) { ?>
				<ul itemscope itemtype="http://schema.org/BreadcrumbList">
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a href="<?php echo home_url(); ?>" itemprop="item">
							<span itemprop="name">Главная</span>
						</a>
						<meta itemprop="position" content="1" />
					</li>
					&nbsp;/&nbsp;
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<span itemprop="name"><?php single_post_title() || post_type_archive_title() ||  single_cat_title(); ?></span>
						<meta itemprop="position" content="2" />
					</li>
				</ul>
			<?php } ?>
		</div>
	</div>