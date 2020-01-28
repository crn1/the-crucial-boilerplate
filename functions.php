<?php

add_theme_support('post-thumbnails');

add_filter( 'excerpt_length', function($length){ return 25; });

function crucial_scriptsAndStyles() {
	wp_enqueue_style('wordpress-required-style', get_stylesheet_uri());
	wp_enqueue_script('react-theme', get_stylesheet_directory_uri() . '/theme.js' , array(), '1.0', true);

	$url = trailingslashit(home_url());
	$path = trailingslashit(parse_url($url, PHP_URL_PATH));

	wp_scripts()->add_data('react-theme', 'data', sprintf( 'var WP = %s;', wp_json_encode(array(
		'api' => esc_url_raw(get_rest_url()),
		'root' => esc_url_raw($url),
	))));
}
add_action( 'wp_enqueue_scripts', 'crucial_scriptsAndStyles' );

 //function get_crucial_posts($request)
 //{
 //	$wordpressPosts = get_posts($request);
 //	$formattedPosts = array();
 //
 //	foreach($wordpressPosts as $post):
 //		if(
 //			!empty($post) &&
 //			is_a($post, 'WP_Post') &&
 //			$post->post_status == 'publish' )
 //		{
 //			$formattedPosts[$post->ID] = array(
 //				'title' => $post->post_title,
 //				'content' => $post->post_content,
 //				'excerpt' => $post->post_excerpt,
 //				'date' => $post->post_date,
 //				'categories' => wp_get_post_categories($post->ID, array()),
 //				'tags' => $post->post_tags ? array_map(function($tag){ return $tag->name; }, $post->post_tags) : [],
 //				'image' => wp_get_attachment_url(get_post_thumbnail_id($post->ID))
 //			);
 //		}
 //	endforeach;
 //
 //	$response = new WP_REST_Response($formattedPosts);
 //	$response->set_status(200);
 //	return $response;
 //}
 //
 //add_action('rest_api_init', function() {
 //	register_rest_route('gold/v1', 'posts/(?P<id>\d+)', array(
 //		'methods' => 'GET',
 //		'callback' => 'get_crucial_posts'
 //	));
 //});
