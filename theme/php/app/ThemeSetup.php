<?php

class ThemeSetup extends Base
{
	public function __construct()
	{
		add_action('after_setup_theme', [$this, 'theme_setup']);
		add_action('wp_enqueue_scripts', [$this, 'gutter_scripts']);
		add_action('wp_footer', [$this, 'deregister_scripts']);

		add_action('after_setup_theme', [$this, 'register_menus']);
		add_action('after_setup_theme', [$this, 'woocommerce_hooks']);

		add_action('admin_init', [WP_Term_Image::class, 'init']);

		add_action('wp_ajax_mail_to', 'mail_to');
		add_action('wp_ajax_nopriv_mail_to', 'mail_to');
	}

	public function theme_setup()
	{
		add_theme_support('post-thumbnails');
		add_theme_support('menus');
		add_post_type_support('page', 'excerpt');

		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
		remove_action('wp_head', 'rest_output_link_wp_head');
		remove_action('wp_head', 'wp_resource_hints', 2);

		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');

		add_filter('navigation_markup_template', function ($template, $class) {
			return '
				<nav class="%1$s" role="navigation">
					<div class="nav-links">%3$s</div>
				</nav>
			';
		}, 10, 2);

		// Filter sidebar
		add_action('widgets_init', function () {
			register_sidebar(array(
				'name'          => 'Filter sidebar',
				'id'            => 'sidebar-filters',
				'description'   => 'Sidebar for filtering products',
				'class'         => '',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => "</li>\n",
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => "</h2>\n",
			));
		});

		add_filter('wpc_terms_before_display', 'wpc_sort_terms_as_needed', 10, 2);
		function wpc_sort_terms_as_needed($terms, $filter)
		{

			if ($filter['e_name'] === '_stock_status') {
				foreach ($terms as $key => $term) {

					if ($term->slug === 'onbackorder') {
						$term->name = 'Под заказ';
					}

					if ($term->slug === 'outofstock') {
						$term->name = 'Нет в наличии';
					}
				}
			}

			return $terms;
		}
	}

	public function register_menus()
	{
		register_nav_menus([
			'category_menu' => 'Меню из категорий',
		]);
	}

	public function deregister_scripts()
	{
		wp_deregister_script('wp-embed');
	}

	public function gutter_scripts()
	{
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
		wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
		wp_enqueue_script('jquery');
		wp_enqueue_style(
			'style',
			get_stylesheet_uri(),
			[],
			filemtime(get_template_directory() . '/style.css')
		);

		wp_enqueue_style('swiper-css', get_template_directory_uri() . '/lib/css/swiper-bundle.min.css', [], '11.2.6');
		wp_enqueue_script('swiper-js', get_template_directory_uri() . '/lib/js/swiper-bundle.min.js', [], '11.2.6', true);

		wp_enqueue_script('imask-js', get_template_directory_uri() . '/lib/js/imask.js', [], '7.6.1', true);

		wp_enqueue_style('toastr-css', get_template_directory_uri() . '/lib/css/toastr.min.css', [], '2.1.4');
		wp_enqueue_script('toastr-js', get_template_directory_uri() . '/lib/js/toastr.min.js', [], '2.1.4', true);

		wp_enqueue_script('micromodal', get_template_directory_uri() . '/lib/js/micromodal.min.js', [], '0.6.1', true);

		if (is_product()) {
			wp_enqueue_script('embla-carousel', get_template_directory_uri() . '/lib/js/embla-carousel.umd.js', [], '1.0', true);
			wp_enqueue_style('embla-carousel-styles', get_template_directory_uri() . '/lib/css/embla-carousel.css', [], '1.0');
		}

		wp_enqueue_script(
			'script-js',
			get_template_directory_uri() . '/js/bundle.js',
			[],
			filemtime(get_template_directory() . '/js/bundle.js'),
			['strategy' => 'defer', 'in_footer' => true]
		);
	}

	public function woocommerce_hooks()
	{
		add_theme_support('woocommerce');
		add_filter('woocommerce_enqueue_styles', '__return_false');

		//update cart count
		add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
			$fragments['span.counter'] = '<span class="counter">' . count(WC()->cart->get_cart()) . '</span>';
			return $fragments;
		});

		// remove result ordering
		remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
		remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
		remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

		remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
		add_action('woocommerce_after_shop_loop', 'custom_woocommerce_pagination', 10);

		function custom_woocommerce_pagination()
		{
			global $wp_query;

			$total_pages = $wp_query->max_num_pages;

			// Проверяем, есть ли страницы для отображения
			if ($total_pages > 1) {
				$current_page = max(1, get_query_var('paged'));

				$pagination_args = array(
					'format'      => '?paged=%#%',
					'current' => $current_page,
					'total'   => $total_pages,
					'mid_size' => 2,
					'prev_text' => '<span class="arrow left"></span>',
					'next_text' => '<span class="arrow right"></span>',
					'class' => '',
					'end_size' => 1,
				);

				echo '<div class="pagination">';
				echo paginate_links($pagination_args);
				echo '</div>';
			}
		}

		//////////////// content-product
		// change 'Распродажа' to 'Акция'
		add_filter('woocommerce_sale_flash', 	function ($html, $post) {
			return '<span class="onsale">Акция</span>';
		}, 10, 2);

		//change card title
		remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
		add_action('woocommerce_shop_loop_item_title', function () {
			global $product;
			echo '<div class="product__card--title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>
			<div><p><span>Код товара: </span><span>' . $product->get_sku() . '</span></p></div>';
		});

		//remove link around product card
		remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
		///////// end content-product


		// single-product.php
		remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
		remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

		// end single-product.php

		// content-single-product.php
		remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		// end content-single-product.php

		// page-cart.php
		remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

		add_filter('woocommerce_currency_symbol', function ($symbol, $currency) {
			if ($currency === 'BYN') {
				$symbol = 'BYN';
			}
			return $symbol;
		}, 10, 2);

		// Добавить количество товаров как отдельную строку в таблице итогов
		function add_items_count_as_cart_total_row()
		{
			$items_count = WC()->cart->get_cart_contents_count();

			// Определяем правильное склонение слова "товар"
			$item_text = $items_count % 10 == 1 && $items_count % 100 != 11 ? 'товар' : ($items_count % 10 >= 2 && $items_count % 10 <= 4 &&
				($items_count % 100 < 10 || $items_count % 100 >= 20) ? 'товара' : 'товаров');

?>
			<tr class="cart-items-total">
				<th>Количество товаров</th>
				<td data-title="Количество товаров"><strong><?php echo $items_count . ' ' . $item_text; ?></strong></td>
			</tr>
		<?php
		}
		// add_action('woocommerce_cart_totals_before_order_total', 'add_items_count_as_cart_total_row');

		// Добавляем информацию о количестве товаров, сумме без скидки и общей скидке в блок оформления заказа
		function add_detailed_cart_information()
		{
			// Получаем объект корзины
			$cart = WC()->cart;

			// Получаем общее количество товаров
			$items_count = $cart->get_cart_contents_count();

			// Определяем правильное склонение слова "товар"
			$item_text = $items_count % 10 == 1 && $items_count % 100 != 11 ? 'товар' : ($items_count % 10 >= 2 && $items_count % 10 <= 4 &&
				($items_count % 100 < 10 || $items_count % 100 >= 20) ? 'товара' : 'товаров');

			// Вычисляем сумму без скидок (регулярную цену всех товаров)
			$regular_total = 0;
			$total_discount = 0;

			// Проходим по всем товарам в корзине
			foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
				$product = $cart_item['data'];
				$quantity = $cart_item['quantity'];

				// Получаем регулярную цену (без скидки)
				if ($product->is_on_sale()) {
					$regular_price = $product->get_regular_price();
					$sale_price = $product->get_sale_price();

					// Добавляем к общей регулярной сумме
					$regular_total += $regular_price * $quantity;

					// Вычисляем размер скидки для данного товара
					$item_discount = ($regular_price - $sale_price) * $quantity;
					$total_discount += $item_discount;
				} else {
					// Если товар без скидки, просто добавляем его цену к регулярной сумме
					$regular_total += $product->get_price() * $quantity;
				}
			}

			// Добавляем скидки от купонов
			$coupon_discount = $cart->get_discount_total();
			$total_discount += $coupon_discount;

			// Выводим информацию перед итоговой суммой
		?>
			<!-- Сумма без скидки -->
			<tr class="regular-total">
				<th><?php echo $items_count . ' ' . $item_text; ?></th>
				<td><?php echo wc_price($regular_total); ?></td>
			</tr>

			<?php if ($total_discount > 0) : ?>
				<!-- Общая скидка -->
				<tr class="total-discount">
					<th>Общая скидка</th>
					<td data-title="Скидка"><?php echo wc_price($total_discount); ?></td>
				</tr>
			<?php endif; ?>
<?php
		}

		// Вставляем нашу информацию перед итоговой суммой
		add_action('woocommerce_cart_totals_before_order_total', 'add_detailed_cart_information');
		// end page-cart.php

		// page-checkout.php
		add_filter('woocommerce_billing_fields', 'custom_billing_fields');

		function custom_billing_fields($fields)
		{
			// Данные клиента

			$fields['billing_first_name'] = array(
				'type'        => 'text',
				'label'       => '',
				'required'    => false,
				'class'       => array('form-row-last'),
				'clear'       => true,
				'placeholder' => 'Имя*'

			);

			$fields['billing_phone'] = array(
				'type'        => 'tel',
				'label'       => '',
				'required'    => true,
				'class'       => array('form-row-wide'),
				'clear'       => true,
				'placeholder' => 'Телефон*',

			);

			$fields['billing_address_1'] = array(
				'label'       => '',
				'required'    => true,
				'class'       => array('form-row-wide'),
				'clear'       => true,
				'placeholder' => 'Улица'
			);

			$fields['billing_address_2'] = array(
				'label'       => '',
				'required'    => false,
				'class'       => array('form-row-wide'),
				'clear'       => true,
				'placeholder' => 'Дом'
			);

			unset($fields['billing_postcode']);
			unset($fields['billing_state']);
			unset($fields['billing_email']);
			unset($fields['billing_last_name']);
			unset($fields['billing_city']);

			return $fields;
		}

		add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

		// Our hooked in function - $fields is passed via the filter!
		function custom_override_checkout_fields($fields)
		{
			$fields['order']['order_comments'] = array(
				'label' => '',
				'required' => false,
				'placeholder' => 'Комментарий к заказу',
			);

			$fields['billing'] = array(
				'billing_country'  => $fields['billing']['billing_country'],
				'billing_first_name' => $fields['billing']['billing_first_name'],
				'billing_phone'      => $fields['billing']['billing_phone'],
				'billing_address_1'  => $fields['billing']['billing_address_1'],
				'billing_address_2'  => $fields['billing']['billing_address_2'],
			);

			return $fields;
		}
		// end page-checkout.php

		// sidebar.php
		// Фильтрация продуктов по состоянию чекбокса
		add_action('woocommerce_product_query', 'filter_products_by_sale');
		function filter_products_by_sale($query)
		{
			if (isset($_GET['on_sale']) && $_GET['on_sale'] === 'yes') {
				$meta_query = $query->get('meta_query');

				$meta_query[] = array(
					'key'     => '_sale_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'NUMERIC'
				);

				$query->set('meta_query', $meta_query);
			}
		}
		// end sidebar.php

		add_filter('woocommerce_is_purchasable', 'disable_backorder_products', 10, 2);

		function disable_backorder_products($purchasable, $product)
		{
			if ($product->is_on_backorder(1)) {
				return false; // Запретить добавление в корзину для товаров под заказ
			}
			return $purchasable;
		}


		// taxonomy-product-cat.php

		function custom_products_per_page($query)
		// Устанавливаем количество товаров на странице
		{
			if (!is_admin() && $query->is_main_query() && (is_product_category() || is_shop())) {
				// Получаем количество из GET-параметра или используем значение по умолчанию
				$per_page = isset($_GET['products_per_page']) ? intval($_GET['products_per_page']) : get_option('posts_per_page');
				$query->set('posts_per_page', $per_page);
			}
		}
		add_action('pre_get_posts', 'custom_products_per_page');

		// end taxonomy-product-cat.php

		// remove calc shipping from cart page, work inside cart-totals.php
		add_filter('woocommerce_cart_ready_to_calc_shipping', function () {
			if (is_cart()) {
				return false;
			}
			return true;
		});
	}
}
