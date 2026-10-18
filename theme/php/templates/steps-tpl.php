<?php
$steps = get_field('stages', get_option('page_on_front'));

if (!empty($steps)) { ?>
	<section class="block steps">
		<img class="steps__bg--right" src="<?= get_template_directory_uri() . '/img/steps__right.png' ?>" alt="">
		<div class="container">
			<div class="block__title">Этапы работы</div>

			<div class="row steps__items">
				<img class="steps__bg--left" src="<?= get_template_directory_uri() . '/img/steps__left.png' ?>" alt="">
				<?php foreach ($steps as $key => $step) { ?>
					<div class="col col-4 col-sm">
						<div class="step">
							<div class="step__num"><?= $key + 1 ?> шаг</div>
							<div class="step__title"><?= $step['title'] ?></div>
							<div class="step__subtitle"><?= $step['subtitle'] ?></div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>