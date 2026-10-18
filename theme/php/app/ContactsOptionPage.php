<?php
class ContactsOptionPage extends Base
{
	public const CONTACT_FIELDS =
	[
		'phone_1' => 'Телефон',
		'email' => 'Email',
		'address' => 'Адрес',
		'viber' => 'Номер Viber',
		'telegram' => 'Telegram User Name',
		'unp' => 'УНП',
		'time_1' => 'Время работы первая строка',
		'time_2' => 'Время работы вторая строка',
	];

	public function __construct()
	{
		add_action('admin_menu', [$this, 'add_menu_page']);
	}

	public function add_menu_page()
	{
		add_menu_page(
			'Контактные данные', // Заголовок страницы
			'Контактные данные', // Название меню
			'manage_options', // Права доступа
			'my-meta-fields', // Уникальный идентификатор
			[$this, 'contacts_fields_page'] // Функция для отображения страницы
		);
	}

	public function contacts_fields_page()
	{
		// Сохранение метаполей
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			foreach (self::CONTACT_FIELDS as $key => $value) {
				if (isset($_POST[$key])) {
					$meta_value = sanitize_text_field($_POST[$key]);
					// Сохранение метаполя в опции
					update_option($key, $meta_value);
				}
			}
			echo '<div class="updated"><p>Контактные данные сохранены!</p></div>';
		}
?>

		<div class="wrap">
			<h1>Добавить контактные данные</h1>
			<form method="post" action="" style="display: flex; flex-direction: column; gap: 5px;">
				<?php
				foreach (self::CONTACT_FIELDS as $key => $value) {
					// Получаем сохранённое значение
					$saved_value = get_option($key, '');
				?>
					<label for="<?php echo $key; ?>"><?php echo $value; ?>:</label>
					<input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo esc_attr($saved_value); ?>"> 
				<?php } ?>
				<?php submit_button('Сохранить контактные данные'); ?>
			</form>
		</div>
<?php
	}
}
