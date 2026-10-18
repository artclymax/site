<?php
$btn_link = $args['btn_link'] ?? '';
$btn_name = $args['btn_name'] ?? 'Узнать больше';
$data_modal = $args['data_modal'] ?? '';
?>

<div class="row">
	<div class="col col-6 col-sm-12 ">
		<div class="about__content">
			<div class="text"><?= get_field('content', get_option('page_on_front')) ?></div>
			<div class="btn">
				<a <?= $data_modal ? $data_modal : '' ?> <?= $btn_link ? 'href="/o-kompanii"' : '' ?> class="cmn-btn cmn-btn--main full"><?= $btn_name ?></a>
			</div>
		</div>
	</div>
	<div class="col col-6 col-sm-12 ">
		<div class="about__img">
			<img src="<?= get_field('img', get_option('page_on_front')) ?>" alt="" loading="lazy">
		</div>
	</div>
</div>