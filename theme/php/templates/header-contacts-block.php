<?php if ($address = get_option('address')) { ?>
	<div class="address">
		<span><?= $address ?></span>
	</div>
<?php } ?>

<div class="phones">
	<?php if ($phone_1 = get_option('phone_1')) { ?>
		<div class="phone_num">
			<a href="tel:<?= $phone_1 ?>"><?= $phone_1 ?></a>
		</div>
	<?php } ?>
	<?php if ($phone_2 = get_option('phone_2')) { ?>
		<div class="phone_num">
			<a href="tel:<?= $phone_2 ?>"><?= $phone_2 ?></a>
		</div>
	<?php } ?>


	<?php if (wp_is_mobile()) { ?>
		<?php if ($phone_3 = get_option('phone_3')) { ?>
			<div class="phone_num">
				<a href="tel:<?= $phone_3 ?>"><?= $phone_3 ?></a>
			</div>
		<?php } ?>
		<?php if ($phone_4 = get_option('phone_4')) { ?>
			<div class="phone_num">
				<a href="tel:<?= $phone_4 ?>"><?= $phone_4 ?> (факс)</a>
			</div>
		<?php } ?>
	<?php } ?>

</div>

<?php if ($email = get_option('email')) { ?>
	<div class="email">
		<a href="mailto:<?= $email ?>"><?= $email ?></a>
	</div>
<?php } ?>

<div class="messengers">
	<a class="viber" href="viber://chat?number=<?= get_option('viber') ?>">
		<img src="<?= get_template_directory_uri() ?>/img/viber.png" alt="">
	</a>
	<a class="telegram" href="tg://resolve?domain=<?= get_option('telegram') ?>">
		<img src="<?= get_template_directory_uri() ?>/img/tg.png" alt="">
	</a>
	<a class="whatsapp" href="https://wa.me/<?= get_option('whatsapp') ?>">
		<img src="<?= get_template_directory_uri() ?>/img/whatsapp.png" alt="">
	</a>
</div>