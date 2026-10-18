<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title('', true, 'right'); ?></title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
		rel="stylesheet">

	<?php wp_head(); ?>

	<script type="text/javascript">
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>
</head>

<body <?php body_class(); ?>>
	<div id="wrapper" class="wrapper">
		<div class="wrapper__container">
			<header class="block__header block__header--bg d-flex">
				<div class="block__header-container">

					<div class="block__header--wrapper d-flex align-items-center">
						<div class="d-flex burger"><span></span></div>
						<div class="block__header-logo mobile">
							<a href="<?= home_url(); ?>">
								<img src="<?= get_template_directory_uri() . '/img/logo.png' ?>" alt="Logo">
							</a>
						</div>

						<div class="block__header--box d-flex justify-content-between align-items-center">
							<div class="block__header-nav">
								<div class="block__header--contacts_container d-flex">
									<div class="block__header-logo">
										<a href="<?= home_url(); ?>">
											<img src="<?= get_template_directory_uri() . '/img/logo.png' ?>" alt="Logo">
										</a>
									</div>

									<?= get_template_part('php/templates/catalog-nav') ?><?php get_search_form(); ?>

									<?php if (!is_cart()) { ?>
										<a class="block__header--cart full__cart" href="<?= wc_get_cart_url() ?>">
											<img src="<?php bloginfo('template_directory'); ?>/img/cart.svg" alt="">
											<span class="counter"><?= count(WC()->cart->get_cart()) ?></span>
										</a>
									<?php } ?>
								</div>

								<nav class="menu-header-container">
									<?php get_search_form(['class' => 'mobile']); ?>
									<ul class="d-flex">
										<?php wp_nav_menu([
											'theme_location' => 'primary',
											'menu' => 'Header menu',
											'items_wrap' => '%3$s',
											'container' => false,
										]); ?>
									</ul>
									<div class="nav-contacts">
										<div class="work_time">
											<div>
												<?php echo wp_kses_post(get_field('contacts_time', 'option') ?? '') ?>
											</div>
										</div>
										<?= get_template_part('php/templates/header-contacts') ?>
									</div>
								</nav>
							</div>

							<div class="block__header-contacts">
								<?= get_template_part('php/templates/header-contacts') ?>
							</div>

							<?php if (!is_cart()) { ?>
								<a class="block__header--cart mobile__cart" href="<?= wc_get_cart_url() ?>">
									<img src="<?php bloginfo('template_directory'); ?>/img/cart.svg" alt="">
									<span class="counter"><?= count(WC()->cart->get_cart()) ?></span>
								</a>
							<?php } ?>

						</div>
					</div>
				</div>
			</header>