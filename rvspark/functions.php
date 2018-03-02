<?php

	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page('Site options');
	}

	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	function my_deregister_scripts(){
		wp_deregister_script('jquery');
			wp_register_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', false, '2.2.4');
			wp_enqueue_script('jquery');
		wp_dequeue_script( 'wp-embed' );
	}
	add_action( 'wp_footer', 'my_deregister_scripts' );

	add_shortcode('phone', 'get_phone');

	function get_phone() {
		$phone = get_field('phone','option');
		$output = '<a href="tel:' .$phone .'">' .$phone .'</a>';
		return $output;
	}

	add_shortcode('year', 'get_year');

	function get_year() {
		$year = date('Y');
		return $year;
	}

	function blogBG() {
		$bgURL = wp_get_attachment_image_src( get_post_thumbnail_id($post), $size);
		echo 'background-image: url(' .$bgURL[0] .');';
	}

	function cta_section() {
		$show = false;
		$show = get_field('add_cta_section');
		if ($show) {

			$title = get_field('cta_headline');
			$desc = get_field('cta_description');
			$bg = get_field('cta_background_color');
			$buttons = get_field('cta_buttons');

			$output = '<section class="cta feature ' .$bg .' z6">';
			$output .= '<div class="wrapper">';
			if ($title) { $output .= '<h2>' .$title .'</h2>'; }
			if ($desc) { $output .= '<p>' .$desc .'</p>'; }

			if (have_rows('cta_buttons')) :
				$output .= '<div class="buttons">';
				$count = 0;
				while (have_rows('cta_buttons')) : the_row(); $count++;
					if (get_sub_field('new_tab')) {
						$target = ' target="_blank"';
					} else {
						$target = '';
					}

					if ($count == 2) {
						$trans = 'trans';
					} else {
						$trans = '';
					}
					$output .= '<a href="' .get_sub_field('link') .'" ' .$target .' class="btn ' .$trans .'">' .get_sub_field('text') .'</a>';
				endwhile;
				$output .= '</div>';
			endif;
			$output .= '</div>'; // wrapper
			$output .= '</section>';

			echo $output;

		} else {
			return false;
		}
	}

	function socialMedia() {

		$results = '';
		$field = 'social_media';
		$postID = 'option';

		if (have_rows($field,$postID)) : 

			$results .= '<ul>';

			while (have_rows($field,$postID)) : the_row();

				$platform = get_sub_field('platform');
				$url = get_sub_field('link');

				switch ($platform) {

					case 'Facebook':
					$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve"><defs></defs><g><path d="M32.5,0c2.1,0,3.8,0.7,5.3,2.2C39.3,3.7,40,5.4,40,7.5v25c0,2.1-0.7,3.8-2.2,5.3c-1.5,1.5-3.2,2.2-5.3,2.2h-4.9V24.5h5.2	l0.8-6h-6v-3.9c0-1,0.2-1.7,0.6-2.2s1.2-0.7,2.4-0.7l3.2,0V6.3C32.7,6.1,31.1,6,29.1,6c-2.4,0-4.2,0.7-5.7,2.1c-1.4,1.4-2.1,3.4-2.1,5.9v4.5h-5.2v6h5.2V40H7.5c-2.1,0-3.8-0.7-5.3-2.2C0.7,36.3,0,34.6,0,32.5v-25c0-2.1,0.7-3.8,2.2-5.3C3.7,0.7,5.4,0,7.5,0H32.5z"/></g></svg>';
					break;

					case 'Google-plus':
					$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve"><defs></defs><g><path d="M37.3,10C39.1,13,40,16.4,40,20s-0.9,7-2.7,10c-1.8,3.1-4.2,5.5-7.3,7.3C27,39.1,23.6,40,20,40c-3.6,0-7-0.9-10-2.7c-3.1-1.8-5.5-4.2-7.3-7.3C0.9,27,0,23.6,0,20s0.9-7,2.7-10C4.5,6.9,6.9,4.5,10,2.7C13,0.9,16.4,0,20,0c3.6,0,7,0.9,10,2.7S35.5,6.9,37.3,10z M23.9,20.2c0-0.6-0.1-1.1-0.2-1.7h-9.4V22h5.7c-0.2,1.3-0.9,2.4-1.9,3.1c-1.1,0.8-2.3,1.2-3.7,1.2c-1.7,0-3.2-0.6-4.4-1.9c-1.2-1.2-1.8-2.7-1.8-4.4s0.6-3.2,1.8-4.4c1.2-1.2,2.7-1.9,4.4-1.9c1.6,0,2.9,0.5,4,1.5l2.7-2.6c-1.9-1.7-4.1-2.6-6.7-2.6c-2.8,0-5.1,1-7.1,2.9c-1.9,2-2.9,4.3-2.9,7.1s1,5.1,2.9,7.1c1.9,2,4.3,2.9,7.1,2.9c2.9,0,5.2-0.9,6.9-2.7C23,25.4,23.9,23.1,23.9,20.2z M32.9,21.4h2.8v-2.9h-2.8v-2.9H30v2.9h-2.9v2.9H30v2.9h2.9V21.4z"/></g></svg>';
					break;

					case 'Instagram':
					$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve"><defs></defs><g><path d="M40,20c0,4,0,6.7-0.1,8.3c-0.2,3.6-1.2,6.4-3.2,8.4c-2,2-4.8,3.1-8.4,3.2C26.7,40,24,40,20,40c-4,0-6.7,0-8.3-0.1c-3.6-0.2-6.4-1.2-8.4-3.2c-2-2-3.1-4.8-3.2-8.4C0,26.7,0,24,0,20s0-6.7,0.1-8.3c0.2-3.6,1.2-6.4,3.2-8.4c2-2,4.8-3.1,8.4-3.2C13.3,0,16,0,20,0c4,0,6.7,0,8.3,0.1c3.6,0.2,6.4,1.2,8.4,3.2c2,2,3.1,4.8,3.2,8.4C40,13.3,40,16,40,20z M22,3.6c-1.2,0-1.9,0-2,0c-0.1,0-0.8,0-2,0c-1.2,0-2.1,0-2.7,0c-0.6,0-1.5,0-2.5,0.1s-1.9,0.1-2.7,0.3C9.3,4.1,8.7,4.2,8.2,4.4C7.3,4.7,6.6,5.3,5.9,5.9C5.3,6.6,4.7,7.3,4.4,8.2c-0.2,0.5-0.4,1.1-0.5,1.9c-0.1,0.7-0.2,1.6-0.3,2.7c0,1.1-0.1,1.9-0.1,2.5c0,0.6,0,1.5,0,2.7c0,1.2,0,1.9,0,2s0,0.8,0,2c0,1.2,0,2.1,0,2.7c0,0.6,0,1.5,0.1,2.5c0,1.1,0.1,1.9,0.3,2.7c0.1,0.7,0.3,1.4,0.5,1.9c0.3,0.9,0.9,1.6,1.5,2.3s1.4,1.2,2.3,1.5c0.5,0.2,1.1,0.3,1.9,0.5c0.7,0.1,1.6,0.2,2.7,0.3c1.1,0,1.9,0.1,2.5,0.1c0.6,0,1.5,0,2.7,0c1.2,0,1.9,0,2,0c0.1,0,0.8,0,2,0c1.2,0,2.1,0,2.7,0c0.6,0,1.5,0,2.5-0.1c1.1,0,1.9-0.1,2.7-0.3c0.7-0.1,1.4-0.3,1.9-0.5c0.9-0.3,1.6-0.9,2.3-1.5s1.2-1.4,1.5-2.3c0.2-0.5,0.3-1.1,0.5-1.9c0.1-0.7,0.2-1.6,0.3-2.7c0-1.1,0.1-1.9,0.1-2.5c0-0.6,0-1.5,0-2.7c0-1.2,0-1.9,0-2s0-0.8,0-2c0-1.2,0-2.1,0-2.7c0-0.6,0-1.5-0.1-2.5c0-1.1-0.1-1.9-0.3-2.7c-0.1-0.7-0.3-1.4-0.5-1.9c-0.3-0.9-0.9-1.6-1.5-2.3c-0.7-0.7-1.4-1.2-2.3-1.5c-0.5-0.2-1.1-0.4-1.9-0.5c-0.7-0.1-1.6-0.2-2.7-0.3s-1.9-0.1-2.5-0.1C24.1,3.6,23.2,3.6,22,3.6z M27.3,12.7c2,2,3,4.4,3,7.3s-1,5.3-3,7.3c-2,2-4.4,3-7.3,3c-2.8,0-5.3-1-7.3-3c-2-2-3-4.4-3-7.3s1-5.3,3-7.3c2-2,4.4-3,7.3-3C22.8,9.7,25.3,10.7,27.3,12.7z M24.7,24.7c1.3-1.3,2-2.9,2-4.7s-0.6-3.4-2-4.7c-1.3-1.3-2.9-2-4.7-2c-1.8,0-3.4,0.7-4.7,2c-1.3,1.3-2,2.9-2,4.7s0.7,3.4,2,4.7c1.3,1.3,2.9,2,4.7,2C21.8,26.7,23.4,26,24.7,24.7z M32.4,7.6c0.5,0.5,0.7,1,0.7,1.7c0,0.7-0.2,1.2-0.7,1.7c-0.5,0.5-1,0.7-1.7,0.7c-0.7,0-1.2-0.2-1.7-0.7c-0.5-0.5-0.7-1-0.7-1.7c0-0.7,0.2-1.2,0.7-1.7c0.5-0.5,1-0.7,1.7-0.7C31.3,6.9,31.9,7.2,32.4,7.6z"/></g></svg>';
					break;

					case 'LinkedIn':
					$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve"><defs></defs><g><path d="M40,7.5v25c0,2.1-0.7,3.8-2.2,5.3c-1.5,1.5-3.2,2.2-5.3,2.2h-25c-2.1,0-3.8-0.7-5.3-2.2C0.7,36.3,0,34.6,0,32.5v-25c0-2.1,0.7-3.8,2.2-5.3C3.7,0.7,5.4,0,7.5,0h25c2.1,0,3.8,0.7,5.3,2.2C39.3,3.7,40,5.4,40,7.5z M12.6,9.8c0-0.9-0.3-1.6-0.9-2.2C11,7,10.2,6.7,9.2,6.7c-1,0-1.8,0.3-2.5,0.9c-0.6,0.6-1,1.3-1,2.2c0,0.9,0.3,1.6,0.9,2.2C7.3,12.7,8.2,13,9.1,13h0c1,0,1.8-0.3,2.5-0.9C12.3,11.5,12.6,10.7,12.6,9.8z M6.2,33.5h6V15.4h-6V33.5z M27.8,33.5h6V23.1c0-2.7-0.6-4.7-1.9-6.1c-1.3-1.4-2.9-2.1-5-2.1c-2.4,0-4.2,1-5.4,3h0.1v-2.6h-6c0.1,1.1,0.1,7.2,0,18.1h6V23.4c0-0.7,0.1-1.1,0.2-1.5		c0.3-0.6,0.7-1.1,1.2-1.5c0.5-0.4,1.2-0.6,1.9-0.6c2,0,3,1.4,3,4.1V33.5z"/></g></svg>';
					break;

					case 'Twitter':
					$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve"><defs></defs><g><path d="M40,7.5v25c0,2.1-0.7,3.8-2.2,5.3c-1.5,1.5-3.2,2.2-5.3,2.2h-25c-2.1,0-3.8-0.7-5.3-2.2C0.7,36.3,0,34.6,0,32.5v-25c0-2.1,0.7-3.8,2.2-5.3C3.7,0.7,5.4,0,7.5,0h25c2.1,0,3.8,0.7,5.3,2.2C39.3,3.7,40,5.4,40,7.5z M33.3,12.6c-1,0.4-2,0.7-3.2,0.9c1.2-0.7,2-1.7,2.4-3c-1.1,0.7-2.3,1.1-3.5,1.3c-1.1-1.1-2.4-1.7-4-1.7c-1.5,0-2.8,0.5-3.9,1.6c-1.1,1.1-1.6,2.4-1.6,3.9c0,0.5,0,0.9,0.1,1.2c-2.2-0.1-4.3-0.7-6.3-1.7c-2-1-3.6-2.4-5-4c-0.5,0.9-0.8,1.8-0.8,2.8c0,2,0.8,3.5,2.4,4.6c-0.8,0-1.7-0.2-2.6-0.7v0.1c0,1.3,0.4,2.5,1.3,3.5c0.9,1,1.9,1.6,3.2,1.9c-0.5,0.1-0.9,0.2-1.3,0.2c-0.2,0-0.6,0-1-0.1c0.4,1.1,1,2,1.9,2.7c0.9,0.7,2,1.1,3.2,1.1c-2,1.6-4.3,2.3-6.8,2.3c-0.5,0-0.9,0-1.3-0.1c2.6,1.6,5.4,2.4,8.4,2.4c1.9,0,3.8-0.3,5.5-0.9c1.7-0.6,3.2-1.4,4.4-2.5c1.2-1,2.3-2.2,3.1-3.6c0.9-1.3,1.5-2.8,2-4.2c0.4-1.5,0.6-2.9,0.6-4.4c0-0.3,0-0.5,0-0.7C31.7,14.6,32.6,13.7,33.3,12.6z"/></g></svg>';
					break;

					case 'YouTube':
					$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="33.1px" height="40px" viewBox="0 0 33.1 40" style="enable-background:new 0 0 33.1 40;" xml:space="preserve"><defs></defs><g><path d="M33.1,28.5c0,3.5-0.2,6.1-0.6,7.8c-0.2,0.9-0.6,1.6-1.3,2.2c-0.7,0.6-1.4,0.9-2.3,1c-2.7,0.3-6.9,0.5-12.4,0.5c-5.5,0-9.7-0.2-12.4-0.5c-0.9-0.1-1.6-0.4-2.3-1s-1.1-1.3-1.3-2.2C0.2,34.6,0,32,0,28.5c0-3.5,0.2-6.1,0.6-7.8c0.2-0.9,0.6-1.6,1.3-2.2c0.7-0.6,1.4-0.9,2.3-1C6.9,17.1,11,17,16.5,17c5.5,0,9.7,0.1,12.4,0.4c0.9,0.1,1.6,0.5,2.3,1c0.7,0.6,1.1,1.3,1.3,2.2C32.9,22.3,33.1,24.9,33.1,28.5z M7.1,22.9h2.4v-2.1h-7v2.1h2.3v12.7h2.2V22.9z M10.8,0h2.3l-2.7,8.9v6H8.1v-6C7.9,7.8,7.5,6.2,6.8,4.2C6.2,2.6,5.8,1.3,5.3,0h2.4l1.6,5.9L10.8,0z M13.5,35.6h2v-11h-2V33C13,33.7,12.6,34,12.2,34c-0.3,0-0.4-0.2-0.5-0.5c0,0,0-0.3,0-0.8v-8.1h-2v8.7c0,0.7,0.1,1.3,0.2,1.6c0.2,0.6,0.6,0.8,1.3,0.8c0.7,0,1.5-0.5,2.3-1.4V35.6z M19.1,7.4v3.9c0,1.2-0.2,2.1-0.6,2.6c-0.6,0.8-1.4,1.1-2.4,1.1c-1,0-1.8-0.4-2.3-1.1c-0.4-0.6-0.6-1.4-0.6-2.6V7.4c0-1.2,0.2-2.1,0.6-2.6c0.6-0.8,1.3-1.1,2.3-1.1c1,0,1.8,0.4,2.4,1.1C18.9,5.4,19.1,6.2,19.1,7.4z M17,11.7V7c0-1-0.3-1.5-1-1.5c-0.6,0-1,0.5-1,1.5v4.7c0,1,0.3,1.6,1,1.6C16.7,13.3,17,12.8,17,11.7z M23.1,32.3v-4.4c0-1.1-0.1-1.8-0.2-2.2c-0.3-0.8-0.8-1.3-1.6-1.3c-0.7,0-1.4,0.4-2.1,1.2v-4.8h-2v14.8h2v-1.1c0.7,0.8,1.4,1.2,2.1,1.2c0.8,0,1.3-0.4,1.6-1.2C23,34.2,23.1,33.4,23.1,32.3z M21.1,27.8v4.7c0,1-0.3,1.5-0.9,1.5c-0.3,0-0.7-0.2-1-0.5v-6.7c0.3-0.3,0.7-0.5,1-0.5C20.8,26.3,21.1,26.8,21.1,27.8z M26.5,3.8V15h-2v-1.2c-0.8,0.9-1.6,1.4-2.3,1.4c-0.7,0-1.1-0.3-1.3-0.8c-0.1-0.4-0.2-0.9-0.2-1.7V3.8h2V12c0,0.5,0,0.8,0,0.8c0,0.3,0.2,0.5,0.5,0.5c0.4,0,0.8-0.3,1.3-1V3.8H26.5z M30.6,32.1v-0.3h-2c0,0.8,0,1.2,0,1.4c-0.1,0.5-0.4,0.8-0.9,0.8c-0.7,0-1-0.5-1-1.5v-1.9h4v-2.3c0-1.2-0.2-2-0.6-2.6c-0.6-0.8-1.4-1.1-2.4-1.1c-1,0-1.8,0.4-2.4,1.1c-0.4,0.6-0.6,1.4-0.6,2.6v3.9c0,1.2,0.2,2,0.6,2.6c0.6,0.8,1.4,1.1,2.4,1.1c1.1,0,1.9-0.4,2.4-1.2c0.3-0.4,0.4-0.8,0.5-1.2C30.6,33.3,30.6,32.8,30.6,32.1z M28.6,27.8v1h-2v-1c0-1,0.3-1.5,1-1.5C28.3,26.3,28.6,26.8,28.6,27.8z"/></g></svg>';
					break;
				}

				$results .= '<li><a href="' .$url .'" title="Follow us on ' .$platform .'" target="_blank" rel="nofollow">' .$icon .'</a></li>';

			endwhile;

			$results .= '</ul>';

		endif;

		echo $results;

	}

?>