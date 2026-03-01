<?php
$section_header = get_sub_field( 'section_header' );
$sec_heading = $section_header['heading'];
$sec_content = $section_header['content'];
$faqs = get_sub_field( 'faqs' );

$attr = buildAttr( array( 'id' => $id, 'class' => $classList ) );
?>

<section <?php echo $attr; ?>>
	<div class="container">
		<div class="row">
			<div class="col col--left">
				<div class="section-header__content">
					<?php if ( ! empty( $sec_heading ) ) : ?>
						<h2 class="section-title position-relative h3">
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
			<div class="col col--right">
				<div class="faqs__block">
					<?php
					foreach ( $faqs as $faq ) :
						get_template_part( 'lib/parts/accordion', '', $faq );
					endforeach;
					?>
				</div>
			</div>
		</div>
	</div>
</section>