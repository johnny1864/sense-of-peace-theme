<?php
$testimonials = get_sub_field( 'blocks' );
$attr = buildAttr( array( 'id' => $id, 'class' => $classList ) );
?>
<div <?php echo $attr; ?>>
	<div class="container container--small relative">
		<?php echo getSVG('banner', false, false) ?>
		<img class="testimonials__house" src="https://wheat-gazelle-627237.hostingersite.com/wp-content/uploads/2026/03/house.png" alt="">
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

									<img class="testimonials__card-stars block mx-auto"
										src="https://wheat-gazelle-627237.hostingersite.com/wp-content/uploads/2026/03/stars.png" alt="">
								<?php endif; ?>
								<div class="testimonials__card-quote">
									<?php echo $quote; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<!-- Arrows -->
			<div class="swiper-button-prev">
				<?php echo getSVG('arrow') ?>
			</div>

			<div class="swiper-button-next">
				<?php echo getSVG('arrow') ?>
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
			const wrapper = el.closest('.testimonials__wrapper');

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
					nextEl: wrapper.querySelector('.swiper-button-next'),
					prevEl: wrapper.querySelector('.swiper-button-prev'),
				},

				pagination: {
					el: wrapper.querySelector('.swiper-pagination'),
					clickable: true
				}
			});
		}, 1000)
	});

</script>