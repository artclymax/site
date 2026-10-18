<?php

class PostTypes extends Base
{
	public const TYPES = [
		// EXAMPLE

		// '...slug'  => [
		// 	'title'              => '...name',
		// 	'gutenberg'          => false,
		// 	'editor'             => true,
		// 	'taxonomy'           => [],
		// 	'slug'               => '...slug',
		// 	'publicly_queryable' => true,
		// 	'supports'            => ['title', 'editor', 'thumbnail', ... ],
		// 	'menu_icon' 				 => '',
		// ],

		// end EXAMPLE

		'services'  => [
			'title'              => 'Услуги',
			'gutenberg'          => false,
			'editor'             => true,
			'taxonomy'           => [],
			'slug'               => 'services',
			'publicly_queryable' => true,
			'supports'            => ['title', 'thumbnail'],
			'menu_icon' 				 => '',
		],
		'portfolio'  => [
			'title'              => 'Портфолио',
			'gutenberg'          => false,
			'editor'             => true,
			'taxonomy'           => [],
			'slug'               => 'portfolio',
			'publicly_queryable' => true,
			'supports'            => ['title', 'thumbnail'],
			'menu_icon' 				 => '',
		],
	];


	public function __construct()
	{
		add_action(
			'init',
			function () {
				self::init();
			},
			20
		);
	}

	public function init(): void
	{
		foreach (self::TYPES as $key => $item) {
			$labels = [
				'name'          => $item['title'],
				'singular_name' => $item['title'],
				'add_new'       => __('Add'),
				'add_new_item'  => __('Add'),
				'edit_item'     => __('Edit'),
				'new_item'      => __('New'),
				'all_items'     => $item['title'],
				'view_item'     => __('View'),
				'search_items'  => __('Search'),
				'not_found'     => __('Post not found'),
				'menu_name'     => $item['title'],
			];

			$args   = [
				'labels'              => $labels,
				'public'              => true,
				'show_in_menu'        => true,
				'menu_icon'           => !empty($item['menu_icon']) ? $item['menu_icon'] : 'dashicons-superhero-alt',
				'menu_position'       => 10,
				'hierarchical'        => false,
				'taxonomies'          => $item['taxonomy'],
				'has_archive'         => true,
				'query_var'           => '',
				'rewrite'             => ['slug' => $item['slug']],
				'supports'            => $item['supports'],
				'show_in_rest'        => $item['gutenberg'],
				'exclude_from_search' => false,
				'publicly_queryable'  => $item['publicly_queryable'],
			];

			if (! $item['editor']) {
				$args['supports'] = array_filter(
					$args['supports'],
					function ($value) {
						return $value !== 'editor';
					}
				);
			}

			register_post_type($key, $args);
		}
	}
}
