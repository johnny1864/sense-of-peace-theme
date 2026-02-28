<?php

$blocks = get_sub_field( 'blocks' );
$cta = get_sub_field( 'cta' );
$attr = buildAttr( array( 'id' => $id, 'class' => $classList ) );
?>

<?php if ( $blocks ) : ?>
	<section <?php echo $attr; ?>>

		<div class="full-width-image-content-blocks__wrapper">

			<!-- Mobile Intro -->
			<div class="full-width-image-content-blocks__block--mobile md:hidden">
				<div class="section-padding-bottom container">
					<hr>
				</div>
				<div class="flex mobile-row">

					<div class="col col--content">
						<div class="full-width-image-content-blocks__content">
							<h2 class="full-width-image-content-blocks__content--title">Are You the Right Fit for a Robeks
								Franchise?
							</h2>
							<div class="full-width-image-content-blocks__content--inner">
								<p>Your success is our priority. Through 30 years of experience, we’ve identified the
									qualifications
									that help our franchise partners thrive. Please review the details below to see if
									you’re a
									strong
									fit for the Robeks franchise opportunity.</p>

							</div>
						</div>
					</div>
					<div class="col col--image">
						<img src="/wp-content/uploads/2026/01/Image_-26-e1767464033515.jpg" alt="">
					</div>
				</div>


				<div class="full-width-image-content-blocks__content">
					<ul>
						<li>Entrepreneurial spirit (highly motivated, community-minded,
							customer-focused)</li>
						<li>Minimum financial requirements:</li>
						<li>One unit: $125,000 liquidity, $325,000 net worth</li>
						<li>Three units (preferred): $250,000 liquidity, $1M net worth</li>
						<li>Commitment to full-time engagement (non-absentee)</li>
						<li>Restaurant experience preferred (not required)</li>
					</ul>
					<div class="text-center">
						<a href="#" class="btn">take the next step</a>
					</div>

				</div>
			</div>

			<!-- Blocks -->
			<?php foreach ( $blocks as $index => $block ) : ?>
				<div class="full-width-image-content-blocks__block--<?php echo $index; ?>">
					<div class="container full-width-image-content-blocks__hr">
						<hr>
					</div>
					<div class="full-width-image-content-blocks__block">

						<div class="flex items-center <?php if ( $index % 2 == 0 )
							echo 'flex-row-reverse'; ?>">
							<div class="col col--image">
								<div class="full-width-image-content-blocks__image">
									<?php
									$image = $block['image'];
									if ( ! empty( $image ) ) :
										?>
										<?php //  echo getIMG( $image['ID'], 'xl', false,array('lazy'=>'false') ); ?>
										<?php
										echo wp_get_attachment_image(
											$image['ID'],
											'full',
											false,
											[
												'class' => '',
												'loading' => 'lazy',
											]
										);
										?>
										<!-- <img loading="lazy" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"> -->
									<?php endif; ?>
								</div>
							</div>

							<div class="col col--content">
								<div class="full-width-image-content-blocks__content 
								<?php if ( $index % 2 != 0 ) :
									echo 'pl-5';
								else :
									echo "pr-5";
								endif;
								?>">
									<?php
									if ( ! empty( $block['title'] ) ) : ?>
										<h2 class="full-width-image-content-blocks__content--title"><?php echo $block['title']; ?>
										</h2>
									<?php endif;
									?>
									<div class="full-width-image-content-blocks__content--inner">
										<?php
										if ( ! empty( $block['content'] ) ) :
											echo $block['content'];
										endif;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php if ( $index == 1 ) : ?>
						<div class="text-center md:hidden mobile-cta">
							<a href="#form-block" class="btn">Claim Your Territory</a>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

	</section>
<?php endif; ?>