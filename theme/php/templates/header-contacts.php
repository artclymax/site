<?php
$phones = get_field('contacts_phones', 'options') ?? [];
?>

<?php if (!empty($phones)): ?>
	<div class="nav-contacts__phones">
		<?php foreach ($phones as $phone):
			$correct_phone = preg_replace("/[^0-9]/", "", $phone['phone']);
			?>
			<div class="nav-contacts__phone">
				<a href="tel:+<?= esc_attr($correct_phone) ?>" class="phone"><?= $phone['phone'] ?></a>
				<?php if (!empty($phone['messengers'])): ?>
					<?php foreach ($phone['messengers'] as $item): ?>
						<?php if ($item == 'vb'): ?>
							<a href="viber://chat?number=<?= esc_attr($correct_phone) ?>" target="_blank">
								<img src="<?= get_template_directory_uri() . '/img/viber.png' ?>" alt="Viber">
							</a>
						<?php endif; ?>
						<?php if ($item == 'tg'): ?>
							<a href="https://t.me/+<?= esc_attr($correct_phone) ?>" target="_blank">
								<img src="<?= get_template_directory_uri() . '/img/tg.png' ?>" alt="Telegram">
							</a>
						<?php endif; ?>
						<?php if ($item == 'wh'): ?>
							<a href="https://wa.me/<?= esc_attr($correct_phone) ?>" target="_blank">
								<img src="<?= get_template_directory_uri() . '/img/whatsapp.png' ?>" alt="WhatsApp">
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>