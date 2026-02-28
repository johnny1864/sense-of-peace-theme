<?php

function buildStyles( $styles ) {
	$buildStyles = '';

	foreach ( $styles as $key => $val ) :
		$buildStyles .= $key . ':' . $val . ';';
	endforeach;

	return rtrim( $buildStyles );
}

function buildAttr( $attr, $val = null ) {
	if ( is_array( $attr ) && ! empty( array_filter( $attr ) ) ) {
		$attrs = $attr;
		$builtAttrs = array();

		foreach ( $attrs as $key => $val ) {
			if ( is_array( $val ) )
				$val = join( ' ', array_filter( $val, 'strlen' ) );
			if ( empty( $val ) )
				continue;

			$builtAttrs[] = $key . '="' . $val . '"';
		}

		return join( ' ', array_filter( $builtAttrs, 'strlen' ) );

	} else {
		if ( is_array( $val ) )
			$val = join( ' ', array_filter( $val, 'strlen' ) );
		if ( empty( $val ) )
			return;

		return $attr . '="' . $val . '"';
	}
}

function handleize( $string ) {
	//Lower case everything
	$string = strtolower( $string );
	//Make alphanumeric (removes all other characters)
	$string = preg_replace( "/[^a-z0-9_\s-]/", "", $string );
	//Clean up multiple dashes or whitespaces
	$string = preg_replace( "/[\s-]+/", " ", $string );
	//Convert whitespaces and underscore to dash
	$string = preg_replace( "/[\s_]/", "-", $string );
	return $string;
}

function limit( $content, $limit = 25 ) {
	if ( empty( $content ) )
		return;

	$excerpt = explode( ' ', $content, $limit );

	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}

	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return $excerpt;
}

function excerpt( $id = 1, $limit = 50 ) {
	$id = $id === 1 ? get_the_ID() : $id;

	return limit( get_the_excerpt( $id ), $limit );
}

function getFile( $path ) {
	if ( is_file( $path ) ) {
		ob_start();
		include $path;
		return ob_get_clean();
	}
	return false;
}

function getSVG( $name, $title = false, $icon = true ) {
	$svgPath = get_template_directory() . '/dist/svgs/';
	$svg = getFile( $svgPath . $name . '.svg' );

	if ( $svg ) {
		// title arg exists and the svg has a title tag to replace
		if ( ! empty( $title ) && preg_match( "/<title>(.+)<\/title>/i", $svg, $matches ) ) {
			$title = '<title>' . $title . '</title>';
			$svg = preg_replace( "/<title>(.+)<\/title>/i", $title, $svg );
		}

		$svgType = $icon ? 'icon' : 'code';

		$html = '<div class="svg-' . $svgType . ' svg-' . $svgType . '--' . $name . '">';
		$html .= ! $icon ? $svg : '<div class="positioner">' . $svg . '</div>';
		$html .= '</div>';

		return $html;
	}

	return false;
}

function getSocialLinks( $socials = null ) {
	if ( is_null( $socials ) )
		$socials = get_field( 'global', 'option' )['contact']['socials'];

	$social_icons = array( 'twitter', 'facebook', 'instagram', 'linkedin', 'pinterest', 'tiktok', 'yelp', 'youtube', 'x' );

	if ( ! empty( $socials ) ) {
		$html = '<nav class="social-links"><ul>';

		foreach ( $socials as $link ) {
			$url = $link['url'];
			$host = parse_url( $url, PHP_URL_HOST );
			$hostParts = explode( '.', $host );
			$domain = $hostParts[ count( $hostParts ) - 2 ];

			$icon = in_array( $domain, $social_icons ) ? $domain : 'world';

			$html .= '<li><a aria-label="link to Robeks ' . $domain . ' page" href="' . $url . '" target="_blank">';
			$html .= getSVG( $icon );
			$html .= '</a></li>';
		}

		$html .= '</ul></nav>';
		return $html;
	}
	return false;
}

function getShareLinks() {
	$page_url = esc_url( 'https:' . get_the_permalink() );
	$page_img = get_the_post_thumbnail_url();
	$page_title = get_the_title();

	$shareLinks = array(
		'twitter' => 'https://twitter.com/intent/tweet?url=' . $page_url . '&text=' . $page_title,
		'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $page_url,
		'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $page_url . '&title=' . $page_title . '&summary=' . $page_title . '%0A' . $page_url,
		'pinterest' => 'https://www.pinterest.com/pin/create/button/?url=' . $page_url . '&media=' . $page_img . '&description=' . $page_title . '%0A' . $page_url,
		'email' => 'mailto:?subject=' . $page_title . '&body=' . $page_title . '%0A' . $page_url
	);

	$html = '<div class="sharelinks">';
	$html .= '<span class="sharelinks__label">Share ' . getSVG( 'download' ) . '</span>';
	$html .= '<div class="sharelinks__list"><ul>';

	foreach ( $shareLinks as $social => $link ) :
		$html .= '<li>';
		$html .= '<a class="sharelinks__link sharelinks__link--' . $social . '" href="' . $link . '" target="_blank">' . getSVG( $social ) . '</a>';
		$html .= '</li>';
	endforeach;

	$html .= '</ul"></div>';
	$html .= '</div>';

	echo $html;
}

function readTime( $content ) {
	$word_count = str_word_count( strip_tags( $content ) );
	$readingtime = ceil( $word_count / 250 );

	$timer = "min read";
	$totalreadingtime = $readingtime . $timer;

	if ( $readingtime != 0 ) {
		return $totalreadingtime;
	}
}

function getIFrameSrc( $embed ) {
	preg_match( '/src="(.+?)"/', $embed, $matches );
	return ! empty( $matches ) ? $matches[1] : esc_html( do_shortcode( $embed ) );
}

function getEmbedVideoSrc( $video ) {
	// Check if the URL contains the "video" shortcode
	if ( has_shortcode( $video, 'video' ) ) {
		// If it does, pass the URL to the getIframeSrc function
		return getIframeSrc( $video );
	} else {

		// Check if the URL is a YouTube URL
		if ( preg_match( '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video, $matches ) ) {
			// Extracted YouTube video ID
			$video_id = $matches[1];
			return "https://www.youtube.com/embed/{$video_id}";
		}
		// Check if the URL is a Vimeo URL
		elseif ( preg_match( '/vimeo\.com\/(?:channels\/\w+\/|groups\/[^\/]+\/videos\/|)(\d+)(?:$|\/|\?)/', $video, $matches ) ) {
			// Extracted Vimeo video ID
			$video_id = $matches[1];
			return "https://player.vimeo.com/video/{$video_id}";
		}
		// If the URL is not from YouTube or Vimeo
		else {
			return "Unsupported video platform";
		}
	}
}


function testimonials_shortcode() {
	$testimonials = get_field( 'testimonials' );
	if ( $testimonials && is_array( $testimonials ) ) :
		ob_start(); ?>


		<?php
		return ob_get_clean();
	endif;
}
add_shortcode( 'testimonials_shortcode', 'testimonials_shortcode' );

