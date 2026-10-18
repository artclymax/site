<?php

spl_autoload_register(function ($class_name) {
	// Путь к папке с классами
	$base_dir = dirname(__DIR__) . '/php/';

	// Заменяем обратные слэши на прямые и добавляем .php
	$file = $base_dir . str_replace('\\', '/', $class_name) . '.php';

	// Если файл существует, подключите его
	if (file_exists($file)) {
		require $file;
	} else {
		// Проверяем вложенные директории
		$file_found = false;

		// Рекурсивная функция для поиска файла
		$file_found = recursiveFileSearch($base_dir, $class_name);

		if (!$file_found && defined('WP_DEBUG') && WP_DEBUG) {
			error_log("File not found: " . $file);
		}
	}
});

/**
 * Рекурсивная функция для поиска файла в директориях
 *
 * @param string $dir Папка для поиска
 * @param string $class_name Имя класса для поиска
 * @return bool
 */
function recursiveFileSearch($dir, $class_name)
{
	$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

	foreach ($iterator as $file) {
		if ($file->isFile() && $file->getBasename('.php') === basename($class_name)) {
			require $file->getPathname();
			return true; // Файл найден и подключен
		}
	}
	return false; // Файл не найден
}
