<?php get_header(); ?>

<main class="katalog-page">
	<section class="katalog">
		<?php get_template_part('/php/templates/breadcrumbs'); ?>
		<div class="container">
			<h1 class="block__title">Каталог</h1>

			<?php
			$product_categories = get_terms([
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
				'exclude' => [15],
				'parent' => 0
			]);
			?>

			<?php if (!empty($product_categories) && !is_wp_error($product_categories)) { ?>
				<div class="row">

					<?php foreach ($product_categories as $category) {
						$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);

						$child_cats = get_terms([
							'taxonomy'   => 'product_cat',
							'hide_empty' => false,
							'parent' => $category->term_id
						]);

					?>

						<div class="col col-3 col-sm-6 col-xs">
							<a href="<?= get_term_link($category->slug, 'product_cat') ?>" class="category__card">
								<?php if ($thumbnail_id) { ?>
									<?= wp_get_attachment_image($thumbnail_id, 'full', false, ['class' => 'category__card--img', 'alt' => $category->name, 'loading' => 'lazy']) ?>
								<?php } else { ?>
									<img src="<?= get_template_directory_uri() . '/img/no-img.png' ?>" width="150" height="140" alt="no-img">
								<?php } ?>


								<div class="category__card--title"><?= $category->name ?></div>

							</a>
						</div>

					<?php	} ?>

				</div>
			<?php } else { ?>

				<div class="inform_message">Категории товаров скоро будут добавлены</div>

			<?php } ?>

		</div>
	</section>

	<section class="block">
		<div class="container">
			<div class="katalog-page__description">
				<h2>Качественные кондиционеры с профессиональным монтажом в Гомельской области</h2>
				<p>В нашем интернет-магазине вы найдете обширный ассортимент климатического оборудования от ведущих мировых производителей. Мы предлагаем исключительно качественные, энергоэффективные и тихие модели кондиционеров, которые создадут комфортный микроклимат в любом помещении - от уютной квартиры до просторного офиса или торгового зала.</p>
				<p>Наши специалисты по климатической технике помогут вам выбрать идеальную модель, учитывая все важные параметры: площадь помещения, особенности его планировки, уровень естественного освещения, требования к энергопотреблению и ваши личные предпочтения по функциональности.</p>
				<p>В ассортименте представлены различные типы климатического оборудования. Настенные сплит-системы прекрасно подойдут для стандартных жилых комнат площадью до 35 квадратных метров, сочетая в себе современный дизайн с интеллектуальной системой управления. Для коммерческих помещений мы предлагаем профессиональные кассетные и канальные системы, обеспечивающие равномерное распределение охлажденного воздуха по всему пространству.</p>
				<p>Особого внимания заслуживают мульти-сплит комплексы - экономичное решение для частных домов и больших квартир, позволяющее подключить до пяти внутренних блоков к одному внешнему. Для тех, кто ценит мобильность, доступны компактные передвижные кондиционеры, не требующие сложного монтажа.</p>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>