<style>
	.testimonials__wrapper .mobile-only {
		display: none;
	}

	.testimonials__col--quote {
		position: relative;
		background-color: #fff;
		padding: 1rem;
	}

	.testimonials__card {
		text-align: center;
		color: #013A51;
        background-color: #fff;
	}

    .testimonials__author-image {
		position: relative;
		max-width: 100px;
        margin: 0 auto;
	}

    .testimonials__author-image img {
        position: relative;
    }

    .testimonials__author-image::before {
        content: '';
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background-color: #d23c77;
    }

	.testimonial__name {
		font-size: 1.25rem;
		font-weight: bold;
	}

	@media screen and (min-width: 1025px) {
		.testimonials__card {
			text-align: left;
            max-width: 1140px;
            margin: 0 auto;
            background-color: transparent;
		}

        .testimonials__col--author,
        .testimonials__row {
            display: flex;
            align-items: center;
        }

        .testimonials__author-meta {
            padding-left: 1.5rem;
        }
	}

	@media screen and (max-width: 1024px) {
		.testimonials__wrapper .mobile-only {
			display: block;
		}

		.testimonials__wrapper .desk-only {
			display: none;
		}
	}
</style>
<div class="testimonials__wrapper swiper">
	<div class="swiper-wrapper">
		<?php
		foreach ( $testimonials as $testimonial ) :

			$img = $item['author_image'] ?? null;
			$name = trim( (string) ( $testimonial['author_name'] ?? '' ) );
			$title = trim( (string) ( $testimonial['author_title'] ?? '' ) );
			$quote = trim( (string) ( $testimonial['quote'] ?? '' ) );
			?>

			<div class="swiper-slide">
				<div class="testimonials__card">
					<div class="testimonials__row">
						<div class="testimonials__col--author">
							<div class="testimonials__author-image">
								<?php if ( $img ) : ?>
									<img loading="lazy" src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
								<?php else : ?>
									<img loading="lazy"
										src="https://www.jbfsale.com/wp-content/uploads/2026/02/default-user.webp" alt="">
								<?php endif; ?>
							</div>
							<div class="desk-only testimonials__author-meta">
								<?php if ( $name ) : ?>
									<h3 class="testimonial__name"><?php echo esc_html( $name ); ?></h3>
								<?php endif; ?>

								<?php if ( $title ) : ?>
									<div class="testimonial__title"><?php echo esc_html( $title ); ?></div>
								<?php endif; ?>
							</div>
						</div>
						<div class="testimonials__col--quote">
							<?php echo $quote; ?>
							<div class="mobile-only">
								<?php if ( $name ) : ?>
									<h3 class="testimonial__name"><?php echo esc_html( $name ); ?></h3>
								<?php endif; ?>

								<?php if ( $title ) : ?>
									<div class="testimonial__title"><?php echo esc_html( $title ); ?></div>
								<?php endif; ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="testimonials-swiper__nav">
		<button class="testimonials-swiper__prev" type="button" aria-label="Previous testimonial"></button>
		<button class="testimonials-swiper__next" type="button" aria-label="Next testimonial"></button>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		const el = document.querySelector('.testimonials-swiper');
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
	});

</script>