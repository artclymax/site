<?php

class Base
{
	protected static $instance;

	public static function init_app(): void {

		ThemeSetup::get_instance();
		ContactsOptionPage::get_instance();
		PostTypes::get_instance();
		WP_Term_Image::get_instance();
	}

	public static function get_instance()
	{
		if (!(static::$instance instanceof static)) {
			static::$instance = new static();
		}
		return static::$instance;
	}
}
