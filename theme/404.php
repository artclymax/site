<?php get_header();
?>

<main class="page error-page">
	<section class="block">
		<div class="container">

			<div class="error_page-content">
				<div class="error_page-head">404</div>
				<div class="error_page-title">Страница не найдена</div>
				<p class="error_page-subtitle">Неправильно введен адрес или такой страницы не существует</p>
				<a href="<?= home_url(); ?>" class="btn cmn-btn cmn-btn--main">На главную</a>
			</div>

		</div>
	</section>

	<?php get_footer() ?>