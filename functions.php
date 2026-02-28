<?php
	/* ========================================================================================================================

	Required external files

	======================================================================================================================== */

	require_once( 'lib/functions/navwalker.php' );
	require_once( 'lib/functions/bodyclass.php' );
    require_once( 'lib/functions/utilities.php' );
    require_once( 'lib/functions/shortcodes.php' );
    require_once( 'lib/functions/acf.php' );
    require_once( 'lib/functions/getimg.php' );
    require_once( 'lib/ajax/loadmore.php' );

	/* ========================================================================================================================

	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme

	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
    add_theme_support( 'title-tag' );

    register_nav_menus(array(
        'main' => 'Main Menu',
        'foot' => 'Footer Menu',
        'foot_legal' => 'Footer - Legal Menu'
    ));

	/* ========================================================================================================================

	Actions and Filters

	======================================================================================================================== */

    add_filter( 'document_title_separator', 'theme_title_separator' );
    function theme_title_separator() {return '|';}

    add_filter('wp_nav_menu', 'do_menu_shortcode');
    function do_menu_shortcode( $menu ){ return do_shortcode( $menu ); }

    add_filter( 'embed_oembed_html', 'wpse_embed_oembed_html', 99, 4 );
    function wpse_embed_oembed_html( $cache, $url, $attr, $post_ID ) {
        $classes = array();
        // Add these classes to all embeds.
        $classes_all = array( 'responsive-container' );
        // Check for different providers and add appropriate classes.

        if ( false !== strpos( $url, 'vimeo.com' ) )  $classes[] = 'vimeo';
        if ( false !== strpos( $url, 'youtube.com' ) || false !== strpos( $url, 'youtu.be' ) ) $classes[] = 'youtube';

        $classes = array_merge( $classes, $classes_all );
        return '<div class="oembed ' . esc_attr( implode( ' ', $classes ) ) . '">' . $cache . '</div>';
    }

    add_filter('the_content', 'wrapIframe');
    function wrapIframe($content) {
        // Match iframe tags
        preg_match_all('/<iframe (.+?)src="(.+?)"(.+?)(<\/iframe>)/', $content, $iframe_matches);

        if (!empty(array_filter($iframe_matches))):
            foreach ($iframe_matches[0] as $iframe):
                $new_iframe = '<div class="video-embed"><iframe class="lazy" src="" data-src="' . $iframe_matches[2][0] . $iframe_matches[3][0] . $iframe_matches[4][0] . '</div>';
                $content = str_replace($iframe, $new_iframe, $content);
            endforeach;
        endif;

        return $content;
    }

	/* ========================================================================================================================

	Scripts

	======================================================================================================================== */
    add_action( 'wp_enqueue_scripts', 'wp_script_object' );
    function wp_script_object() {
        global $wp_query;

        wp_register_script( 'my_loadmore', null );
        wp_localize_script( 'my_loadmore', 'WP', array(
            'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
            'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
            'max_page' => $wp_query->max_num_pages
        ) );

         wp_enqueue_script( 'my_loadmore' );
    }

	/**
	 * Add scripts and styles via wp_head()
	 */

    /**
     * Enqueue Tailwind scripts and styles.
     */
    add_action( 'wp_enqueue_scripts', 'enqueue_tailwind_styles' );
    function enqueue_tailwind_styles() {
        wp_enqueue_style( 'tailwind-styles', get_template_directory_uri() . '/dist/tailwind/tailwind.css', array() );
    }

	add_action( 'wp_enqueue_scripts', 'pdm_scripts_styles' );
	function pdm_scripts_styles() {
		wp_deregister_script( 'jquery' );
		wp_enqueue_style( 'styles', get_template_directory_uri().'/dist/main.css' );
		wp_enqueue_script( 'jquery', includes_url( '/js/jquery/jquery.min.js' ) );
		wp_enqueue_script( 'site', get_template_directory_uri().'/dist/bundle.min.js', array( 'jquery' ), false, true );
	}

    add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );
    function dequeue_jquery_migrate( $scripts ) {
        if ( !is_admin() && !empty( $scripts->registered['jquery'] ) ) {
            $scripts->registered['jquery']->deps = array_diff(
                $scripts->registered['jquery']->deps,
                [ 'jquery-migrate' ]
            );
        }
    }

    add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
    function wps_deregister_styles() { wp_dequeue_style( 'wp-block-library' ); }

    add_action( 'wp_footer', 'my_deregister_wp_embed' );
	function my_deregister_wp_embed(){ wp_deregister_script( 'wp-embed' ); }

	/**
	* Disable the emoji's
	*/
	add_action( 'init', 'disable_emojis' );
	function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
		add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
	}
	/**
	* Filter function used to remove the tinymce emoji plugin.
	*
	* @param array $plugins
	* @return array Difference betwen the two arrays
	*/
	function disable_emojis_tinymce( $plugins ) {
        if ( is_array( $plugins ) ) return array_diff( $plugins, array( 'wpemoji' ) );

        return array();
	}
	/**
	* Remove emoji CDN hostname from DNS prefetching hints.
	*
	* @param array $urls URLs to print for resource hints.
	* @param string $relation_type The relation type the URLs are printed for.
	* @return array Difference betwen the two arrays.
	*/
	function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
			/** This filter is documented in wp-includes/formatting.php */
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}
		return $urls;
	}

    // Update CSS within in Admin
    add_action('admin_enqueue_scripts', 'admin_style');
    function admin_style() {
        wp_enqueue_style('admin-styles', get_template_directory_uri().'/dist/admin.css');
        wp_enqueue_script('admin-scripts', get_template_directory_uri().'/dist/admin.js', ['jquery'], false, true);
    }

    add_action('init', function() {
        $load = null;
        $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');

        switch ($url_path) {
            case 'styleguide':
              $load = locate_template('lib/layout/styleguide.php', true);
            break;
        }
        if ($load) exit(); // just exit if template was found and loaded
    });


function charity_intro_shortcode() {
	$charity_name = get_field('charity_name');
	if(!empty($charity_name)) :
		ob_start();
		?>
			<div class="charity-intro">
				<h2>JBF <span><?php the_title(); ?></span> is proud to support <?php echo $charity_name; ?></h2>
			</div>
		<?php

		return wp_kses_post( ob_get_clean() );
	endif;
}

add_shortcode('charity_intro', 'charity_intro_shortcode');