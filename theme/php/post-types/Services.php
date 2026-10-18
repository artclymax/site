<?php

class Services
{
	static public function get_services()
	{
		$categories = get_categories(array(
			'taxonomy' => 'category',
			'hide_empty' => false,
			'type' => 'services',
			'exclude' => array(1),
			'order' => 'DESC',
		));

		$result = [];

		foreach ($categories as $category) {
			// dump($category);
			$image_id = get_term_meta($category->term_id, '_thumbnail_id', 1);
			$image_url = wp_get_attachment_image_url($image_id, 'full');

			$result[] = [
				'id' => $category->term_id,
				'title' => $category->name,
				'description' => $category->description,
				'link' => get_term_link($category),
				'img' => $image_url ?? '',
			];
		}

		return $result;
	}
}
