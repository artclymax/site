<?php

require_once get_template_directory() . '/includes/autoloader.php';
require_once get_template_directory() . '/php/mailTo.php';

Base::init_app();

function dump($args)
{
	echo '<pre>';
	print_r($args);
	echo '</pre>';
}

/**
 * Отправка события purchase в Google Tag Manager dataLayer для WooCommerce
 */
add_action('woocommerce_thankyou', 'stroyclimat_gtm_ecommerce_purchase', 10, 1);
function stroyclimat_gtm_ecommerce_purchase($order_id)
{
	if (!$order_id) {
		return;
	}

	// Получаем объект заказа WooCommerce
	$order = wc_get_order($order_id);

	$items = array();
	// Цикл по всем товарам в чеке
	foreach ($order->get_items() as $item_id => $item) {
		$product = $item->get_product();
		if ($product) {
			$items[] = array(
				'item_id' => (string) $product->get_id(),
				'item_name' => $item->get_name(),
				'price' => (float) $order->get_item_subtotal($item, false, true),
				'quantity' => (int) $item->get_quantity(),
			);
		}
	}

	// Формируем структуру под стандарт GA4 / GTM Ecommerce
	$ecommerce_data = array(
		'transaction_id' => (string) $order_id,
		'value' => (float) $order->get_total(),
		'currency' => $order->get_currency(),
		'items' => $items
	);
	?>
	<script>
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			'event': 'purchase',
			'ecommerce': <?php echo json_encode($ecommerce_data, JSON_UNESCAPED_UNICODE); ?>
		});
	</script>
	<?php
}

/**
 * Установка Google Tag Manager в <head>
 */
add_action('wp_head', 'stroyclimat_add_gtm_head', 1);
function stroyclimat_add_gtm_head()
{
	?>
	<script>(function (w, d, s, l, i) {
			w[l] = w[l] || []; w[l].push({
				'gtm.start':
					new Date().getTime(), event: 'gtm.js'
			}); var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
					'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-THFRXJMG');</script>
	<?php
}

/**
 * Установка Google Tag Manager (noscript) в подвал сайта
 */
add_action('wp_footer', 'stroyclimat_add_gtm_noscript');
function stroyclimat_add_gtm_noscript()
{
	?>
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-THFRXJMG" height="0" width="0"
			style="display:none;visibility:hidden"></iframe></noscript>
	<?php
}
//!=== REVIEWS =====================================
add_action('init', function () {
	register_post_type(
		'review',
		array(
			'labels' => array(
				'name' => __('Отзывы', 'textdomain'),
				'singular_name' => __('Отзыв', 'textdomain'),
				'add_new' => __('Добавить новый', 'textdomain'),
				'add_new_item' => __('Добавить новый отзыв', 'textdomain'),
				'edit_item' => __('Редактировать отзыв', 'textdomain'),
			),
			'public' => true,
			'has_archive' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
			'menu_icon' => 'dashicons-format-quote',
		)
	);
});

add_action('wpcf7_mail_sent', 'cf7_save_review_with_acf_final');

function cf7_save_review_with_acf_final($contact_form)
{
	if ($contact_form->id() != 1242) {
		return;
	}

	$submission = WPCF7_Submission::get_instance();
	if (!$submission)
		return;

	$posted_data = $submission->get_posted_data();

	$reviewer_name = sanitize_text_field($posted_data['your-name']);
	$review_text = sanitize_textarea_field($posted_data['your-review']);

	$rating_field_name = 'your-rating';
	$rating_raw = isset($posted_data[$rating_field_name]) ? $posted_data[$rating_field_name] : '5';

	// === ГЛАВНОЕ ИСПРАВЛЕНИЕ ===
	// 1. Если это настоящий массив PHP (стандартное поведение CF7)
	if (is_array($rating_raw)) {
		$rating_raw = $rating_raw[0];
	}
	// 2. Если это строка вида '["3"]' (как вы обнаружили)
	elseif (is_string($rating_raw)) {
		// Удаляем скобки и кавычки, оставляя только чистую цифру
		$rating_raw = str_replace(['[', ']', '"', "'"], '', $rating_raw);
	}

	// 3. Теперь безопасно превращаем чистую строку "3" в число 3
	$rating = intval($rating_raw);

	// Страховка: если вдруг получилось не число от 1 до 5, ставим 5
	if ($rating < 1 || $rating > 5) {
		$rating = 5;
	}
	// ==========================

	if (empty($reviewer_name) || empty($review_text)) {
		return;
	}

	$new_review_data = array(
		'post_title' => $reviewer_name,
		'post_content' => $review_text,
		'post_status' => 'pending',
		'post_type' => 'review',
		'post_author' => 1,
		'comment_status' => 'closed',
		'ping_status' => 'closed',
	);

	$post_id = wp_insert_post($new_review_data);

	if ($post_id && !is_wp_error($post_id)) {
		update_field('review_rating', $rating, $post_id);
	}
}

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('star-rating', get_template_directory_uri() . '/star-rating/star-rating.min.css');
	wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css');
	wp_enqueue_style('style-rating-section', get_template_directory_uri() . '/star-rating/style.css');
	wp_enqueue_script('star-rating', get_template_directory_uri() . '/star-rating/star-rating.min.js', array(), '1.0.0', true);
	wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js', array(), '1.0.0', true);
	wp_enqueue_script('star-rating-js', get_template_directory_uri() . '/star-rating/main.js', array('fancybox'), '1.0.0', true);
});