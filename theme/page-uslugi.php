<?php get_header(); ?>

<main class="page page-uslugi">

	<section class="block uslugi">
		<?php get_template_part('/php/templates/breadcrumbs'); ?>
		<div class="container">
			<div class="block__title"><?= get_the_title() ?></div>

			<?php if ($services = Services::get_services()) { ?>

				<div class="row">
					<?php foreach ($services as $service) { ?>
						<div class="col col-4 col-sm">
							<div class="card">
								<div class="card__img"><img src="<?= $service['img'] ?>" alt="<?= $service['title'] ?>"></div>
								<div class="card__title"><?= $service['title'] ?></div>
								<div class="card__subtitle"><?= $service['description'] ?></div>
								<div class="card__btn">
									<a href="<?= $service['link'] ?>" class="cmn-btn cmn-btn--main cmn-btn--main-md grey">Подробнее</a>
								</div>
							</div>
						</div>

					<?php } ?>

				<?php } ?>

				</div>
	</section>

	<?php get_footer(); ?>