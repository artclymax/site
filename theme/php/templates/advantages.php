<?php $advantages = get_field('advantages', get_option('page_on_front')); ?>
<section class="block advantages">
	<div class="container">
		<div class="block__title">Преимущества работы с нами</div>
		<div class="row">
			<?php foreach ($advantages as $advantage) { ?>
				<div class="col col-6 col-sm">
					<div class="advantages__item">
						<div class="advantages__title"><?= $advantage['title'] ?></div>
						<div class="advantages__subtitle"><?= $advantage['subtitle'] ?></div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>