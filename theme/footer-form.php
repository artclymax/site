<section class="block contact-form">
	<div class="container">
		<div class="contact-form__wrapper">
			<div class="text">
				<h2 class="title">Остались вопросы?</h2>
				<p class="subtitle">Оставьте ваши контактные данные. Проконсультируем по всем интересующим вопросам и поможем
					подобрать климатическую технику</p>
			</div>

			<form id="feedback-form-1" class="feedback-form" method="post">
				<div class="feedback-form__wrapper">

					<div class="inputs">
						<div>
							<input type="text" name="name" placeholder="Имя" require>
							<div class="warning warning--name">Поле имя обязательно для заполнения</div>
						</div>

						<div>
							<input type="tel" name="phone" placeholder="+375 (_ _) _ _ _-_ _-_ _" require>
							<div class="warning warning--phone">Поле телефон обязательно для заполнения</div>
						</div>
					</div>

					<input type="hidden" name="action" value="mail_to">

					<div class="policy">
						<label for="policy-1">
							<input type="checkbox" name="policy" id="policy-1" checked>
							<div>
								Даю свое согласие на обработку <a href="/policy">персональных данных.</a>
							</div>
						</label>
						<div class="warning warning--policy">Вы не согласились с условиями</div>
					</div>

					<button class="btn cmn-btn cmn-btn--main" type="submit">
						Отправить
						<span class="loader"></span>
					</button>
				</div>
			</form>

			<img class="contact-form__img" src="<?= get_template_directory_uri() ?>/img/form-img.png" alt="Img">

			<?php if (!empty($phones = get_field('contacts_phones', 'options'))): ?>
				<div class="contacts">
					<p class="text">Позвоните нам или напишите</p>
					<?php foreach ($phones as $phone):
						$correct_phone = preg_replace("/[^0-9]/", "", $phone['phone']);
						?>
						<div class="phone">
							<a href="tel:+<?= esc_attr($correct_phone) ?>"><?php echo esc_html($phone['phone']) ?></a>
							<div class="icons">
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
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_template_part('footer'); ?>