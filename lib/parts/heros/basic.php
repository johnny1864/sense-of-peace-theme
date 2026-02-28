<section <?php echo $classes; ?>>
	<div class="hero__wrapper">
		<div class="container  relative">
			<div class="hero__row row">
				<div class="col col--content text-center lg:text-left">
					<h1 class="hero__title"><?php echo $title; ?></h1>
					<?php if ( ! empty( $hero['content'] ) ) : ?>
						<div class="hero__content"><?php echo $hero['content']; ?></div>
					<?php endif; ?>
				</div>
				<div class="col col--image">
					<div class="hero__image">
						<?php echo $feat_img; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if ( $hero['usps'] ) : ?>
		<div class="hero__usps relative">
			<div class="container">
				<div class="hero__usps--wrapper swiper">
					<div class="swiper-wrapper md:justify-between">
						<?php foreach ( $hero['usps'] as $usp ) : ?>
							<div class="hero__usps--block swiper-slide text-center">
								<?php if ( ! empty( $usp['icon'] ) ) : ?>
									<div class="hero__usps--icon mx-auto">
										<?php echo getIMG( $usp['icon']['ID'] ); ?>
									</div>
								<?php endif; ?>
								<div class="hero__usps--text">
									<?php echo $usp['text']; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<!-- Arrows -->
					<div class="swiper-button-prev mob-only md:hidden"></div>
					<div class="swiper-button-next mob-only md:hidden"></div>

					<!-- Dots -->
					<div class="swiper-pagination md:hidden"></div>
				</div>

				<div class="hero__usps-subcontent text-center mx-auto">
					<?php if ( ! empty( $hero['usps_subcontent'] ) ) : ?>
						<?php echo $hero['usps_subcontent']; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>