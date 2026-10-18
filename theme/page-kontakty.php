<?php get_header();
$phones = get_field('contacts_phones', 'options') ?? [];
?>

<main class="page page-kontakty">

	<section class="block kontakty">

		<?php get_template_part('/php/templates/breadcrumbs'); ?>
		<div class="container">

			<h1 class="block__title"><?= get_the_title(); ?></h1>

			<div class="row">
				<div class="col col-4 col-sm">
					<div class="kontakty__content">
						<?php if (!empty($phones)): ?>
							<?php foreach ($phones as $phone):
								$correct_phone = preg_replace("/[^0-9]/", "", $phone['phone']);
								?>
								<div class="kontakty__phones">

									<div class="d-flex">
										<a href="tel:+<?= esc_attr($correct_phone) ?>" class="phone">
											<?php echo esc_html($phone['phone']) ?>
										</a>
									</div>


									<div class="kontakty__messengers">
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
								</div>
							<?php endforeach; ?>
						<?php endif; ?>

						<?php if ($email = get_field('contacts_email', 'option')) { ?>
							<div>
								<div class="kontakty__email">
									<a href="mailto:<?= $email ?>" class="email"><?= $email ?></a>
								</div>
							</div>
						<?php } ?>

						<?php if ($address = get_field('contacts_address', 'option')) { ?>
							<div>
								<div id="office" class="kontakty__address">
									<div class="address">
										<?php echo wp_kses_post($address) ?>
									</div>
								</div>
							</div>
						<?php } ?>

						<div class="kontakty__work_time">
							<div class="work_time">
								<div>
									<?php echo wp_kses_post(get_field('contacts_time', 'option')) ?>
								</div>
							</div>
						</div>

						<?php if (!empty($socials = get_field('contacts_socials', 'option'))): ?>
							<div class="socials">
								<?php foreach ($socials as $social): ?>
									<a href="<?= $social['link']['url'] ?>" target="_blank">
										<img src="<?= $social['icon']['url'] ?>" alt="<?= $social['link']['title'] ?>">
									</a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="col col-8 col-sm">
					<div class="kontakty__map">
						<iframe
							src="https://yandex.ru/map-widget/v1/?um=constructor%3Aac41fe52646365d6e1618ce604ba0c2c23ba6f97b252b309469feca5950f1766&amp;source=constructor"
							width="100%" height="440" frameborder="0"></iframe>
					</div>
				</div>


			</div>

		</div>
	</section>

	<?php get_footer();
