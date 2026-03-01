<?php
$testimonials = get_sub_field( 'blocks' );
$attr = buildAttr( array( 'id' => $id, 'class' => $classList ) );
?>
<div <?php echo $attr; ?>>
	<div class="container container--small relative">
		<img class="testimonials__house" src="http://sense-peace.local/wp-content/uploads/2026/02/house.png" alt="">
		<div class="testimonials__wrapper relative">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php
					foreach ( $testimonials as $testimonial ) :

						$img = $item['author_image'] ?? null;
						$name = trim( (string) ( $testimonial['author'] ?? '' ) );
						$quote = trim( (string) ( $testimonial['quote'] ?? '' ) );
						?>

						<div class="swiper-slide">
							<div class="testimonials__card mx-auto text-center">
								<?php if ( $name ) : ?>
									<h5 class="testimonials__card-author">
										<?php echo esc_html( $name ); ?>
									</h5>
									
									<img class="testimonials__card-stars block mx-auto" src="http://sense-peace.local/wp-content/uploads/2026/02/stars.png" alt="">	
								<?php endif; ?>
								<div class="testimonials__card-quote">
									<?php echo $quote; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="testimonials-swiper__nav">
				<button class="testimonials-swiper__prev" type="button" aria-label="Previous testimonial"></button>
				<button class="testimonials-swiper__next" type="button" aria-label="Next testimonial"></button>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</div>

<script defer>
	document.addEventListener('DOMContentLoaded', () => {
		setTimeout(function () {
			const el = document.querySelector('.testimonials__wrapper .swiper');
			if (!el || typeof Swiper === 'undefined') return;

			new Swiper(el, {
				slidesPerView: 1,
				loop: true,
				speed: 500,

				autoplay: {
					delay: 5000,
					disableOnInteraction: false,
					pauseOnMouseEnter: true,
				},

				navigation: {
					nextEl: el.querySelector('.testimonials-swiper__next'),
					prevEl: el.querySelector('.testimonials-swiper__prev'),
				},
			});
		}, 1000)
	});

</script>