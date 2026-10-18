</main>

</div> <!-- # END wrapper__container -->
<footer id="footer" class="block__footer d-flex">
	<div class="container">
		<div class="block__footer-box d-flex">

			<div class="block__footer-wrapper d-flex">

				<div class="info__block">
					<div class="info__block--logo">
						<a href="<?= home_url(); ?>">
							<!-- LOGO -->
							<img src="<?= get_template_directory_uri() . '/img/logo.png' ?>" alt="" srcset="">
						</a>
					</div>

					<div class="info__block--content">
						<div class="work_time">
							<?= wp_kses_post(get_field('footer_copy', 'options')) ?>
						</div>
						<?php if ($unp = get_field('contacts_unp', 'option')) { ?>
							<div class="work_time">
								УНП <?= $unp ?>
							</div>
						<?php } ?>
					</div>

					<div class="info__block--links">
						<a href="/privacy-policy">Политика конфиденциальности</a>
						<a href="/cookie-policy">Политика обработки файлов cookie</a>
					</div>
				</div>

				<div class="block__footer-nav footer__item">
					<div class="title">Меню</div>
					<nav>
						<ul>
							<?php wp_nav_menu([
								'theme_location' => 'primary',
								'menu' => 'Footer menu',
								'items_wrap' => '%3$s',
								'container' => false,
							]); ?>
						</ul>
					</nav>
				</div>


				<div class="contacts footer__item">
					<div class="title">Контакты</div>

					<div class="contacts__items">
						<div class="contacts__item">
							<div class="contacts__item--title">Электронная почта:</div>
							<div class="contacts__item--contact">
								<?php if ($email = get_field('contacts_email')) {
									echo '<a class="email" href="mailto:' . $email . '">' . $email . '</a>';
								} ?>
							</div>
						</div>
						<div class="contacts__item">
							<div class="contacts__item--title">Номера телефонов:</div>
							<?php if (!empty($phones = get_field('contacts_phones', 'options'))): ?>
								<?php foreach ($phones as $phone): ?>
									<div class="contacts__item--contact">
										<?php if ($phone) {
											$correct_phone = preg_replace("/[^0-9]/", "", $phone['phone']);
											echo '<a class="phone" href="tel:+' . $correct_phone . '">' . $phone['phone'] . '</a>';
										} ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<div class="contacts__item">
							<div class="contacts__item--title">Мессенджеры:</div>
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

				</div>
			</div>

		</div>
	</div>
</footer>
</div> <!-- # END wrapper -->
<?php wp_footer(); ?>

<?php if (is_product()) { ?>
	<?php
	global $product;

	$main_img_id = $product->get_image_id();
	$images_id = $product->get_gallery_image_ids();
	array_unshift($images_id, $main_img_id);
	?>
	<div class="modal micromodal-slide" id="embla-modal">
		<div class="modal__overlay" tabindex="-1" data-embla-close>
			<div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="embla-modal-title">
				<header class="modal__header">
					<button class="modal__close" aria-label="Close modal" data-embla-close></button>
				</header>
				<div class="modal__content" id="embla-modal-content">


					<div class="embla embla-2">
						<div class="embla__viewport">
							<div class="embla__container">

								<?php
								foreach ($images_id as $image_id) {
									$url_img = wp_get_attachment_url($image_id);

									if (!$url_img) {
										$url_img = get_template_directory_uri() . '/img/no-photo.jpg';
									}
									?>

									<div class="embla__slide">
										<div class="embla__slide__number">
											<img class="thumbnail thumbnail-product" src="<?= $url_img ?>" data-large="<?= $url_img ?>" alt=""
												loading='lazy'>
										</div>
									</div>

								<?php } ?>

							</div>
						</div>


						<div class="embla-thumbs">
							<div class="embla-thumbs__viewport">
								<div class="embla-thumbs__container">

									<?php
									if (count($images_id) > 1) {
										foreach ($images_id as $image_id) {
											$url_img = wp_get_attachment_url($image_id);
											?>

											<div class="embla-thumbs__slide embla-thumbs__slide--selected">
												<button type="button" class="embla-thumbs__slide__number">
													<img src="<?= $url_img ?>" alt="">
												</button>
											</div>

										<?php }
									} ?>

								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
<?php } ?>


</body>

</html>