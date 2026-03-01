<?php
$section_header = get_sub_field( 'section_header' );
$sec_heading = $section_header['heading'];
$sec_content = $section_header['content'];
$bg_image = get_sub_field( 'bg_image' );
$form_shortcode = get_sub_field( 'form_shortcode' );
$attr = buildAttr( array( 'id' => $id, 'class' => $classList ) );
?>

<section id="form-block" <?php echo $attr; ?> <?php echo getIMG( $bg_image['ID'], "xxl", true ); ?>>
	<?php if ( $bg_image ) : ?>
		<!-- <div class="form-block__bg-image">
		<?php echo getIMG( $bg_image['ID'], "xxl" ); ?>
		</div> -->
	<?php endif; ?>
	<div class="container relative">
		<div class="form-block__box">
			<div id="form-block__section-header" class="section-header">
				<div class="section-header__content text-center">
					<?php if ( ! empty( $sec_heading ) ) : ?>
						<h2 class="section-title position-relative">
							<?php echo $sec_heading; ?>
						</h2>
					<?php endif; ?>

					<?php if ( ! empty( $sec_content ) ) : ?>
						<div class="section-header__text position-relative">
							<?php echo $sec_content; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="form-block__form">
				<?php echo do_shortcode( $form_shortcode ) ?>
			</div>
		</div>
	</div>
</section>