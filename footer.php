<?php global $global, $site_logo;
$footer = get_field( 'footer', 'option' );
$footer_content = $footer['footer_content'];
if ( ! empty( $footer['site_logo'] ) )
	$site_logo = getIMG( $footer['site_logo']['ID'], 'md', false, array( 'alt' => get_bloginfo( 'name' ), 'lazy' => false ) );

$footer_banner = $footer['footer_banner'];
?>

</main>

<div class="gfooter__banner section">
	<div class="container">
		<div class="flex items-center justify-around gap-5">
			<div class="gfooter__banner-image w-1/3">
				<?php if ( $footer_banner['logo_1'] ) : ?>
					<?php echo getIMG( $footer_banner['logo_1']['ID'] ) ?>
				<?php endif; ?>
			</div>
			<div class="gfooter__banner-image w-1/3">
				<?php if ( $footer_banner['logo_2'] ) : ?>
					<?php echo getIMG( $footer_banner['logo_2']['ID'] ) ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<footer class="gfooter">
	<div class="gfooter__content ">
		<div class="container">
			<div class="lg:flex items-start justify-around gap-5">
				<div class="gfooter__location text-center lg:w-1/2">
					<div class="gfooter__icon">
						<?php echo getSVG( 'address-pin' ) ?>
					</div>
                    <h5 class="h5" style="color: #514f4f !important;">
                        <a style="text-decoration: underline !important;" aria-label="link to Sense of Peace Contact page" target="_black" href="https://www.senseofpeacehomecare.com/contact"> ADDRESS</a>
                    </h5>
					<a href="https://www.senseofpeacehomecare.com/contact" class="h5">
						867 Berkshire Blvd.<br>
						Suite 101<br>
						Wyomissing, PA 19610
					</a>
					<div class="">
						<img src="https://lirp.cdn-website.com/e026569c/dms3rep/multi/opt/Home-Care-Pulse-Certified-Trusted-Provider-150x76-1920w.png"
							alt="Trusted In Home Care Provider">
					</div>
				</div>

				<div class="gfooter__contact text-center lg:w-1/2">
					<div class="gfooter__icon">
						<?php echo getSVG( 'cell-phone' ) ?>
					</div>
                    <h5 class="h5" style="color: #514f4f !important;">
                        <a aria-label="link to Sense of Peace Contact page" target="_black" href="https://www.senseofpeacehomecare.com/contact"> contact</a>
                    </h5>
					<div class="">
						<a class="h5 no-underline" href="tel:4846712908">(484) 671-2908</a>
						<br>
						<a class="h5 " href="mailto:tanya@senseofpeacehomecare.com">tanya@senseofpeacehomecare.com</a>
					</div>
					<div class="footer-socials flex justify-center items-center">
						<?php echo getSocialLinks(); ?>
						<a class="mail-icon" href="mailto:tanya@senseofpeacehomecare.com">
							<?php echo getSVG( 'email' ) ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="gfooter__bottom">
		<div class="container">
			<div class="wrapper text-center">
				<?php //echo getSocialLinks(); ?>
				<h4>
					"SMS/TEXT MESSAGING PRIVACY POLICY" <sup>TM</sup>	
				</h4>
                <a class="h5" style="color: #514f4f !important;"
                    href="https://irp.cdn-website.com/e026569c/files/uploaded/Sense+of+Peace+Home+Care+SMS-Text+Messaging+Privacy+Policy.pdf">
                    "SMS/TEXT MESSAGING PRIVACY POLICY" 
                </a>
				<div class="gfooter__copy">
					<p class="copy">
						&copy; <?php echo date( "Y" ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.<br>
						| All rights reserved |
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>

<div class="pdm-lightbox pdm-lightbox--reset">
	<div class="pdm-lightbox__container">
		<button class="pdm-lightbox__close" type="button">Close Popup</button>
		<div class="pdm-lightbox__content"></div>
	</div>
</div>

<?php wp_footer(); ?>

<?php echo get_field( 'body_scripts_bottom', 'option' ); ?>
</body>

</html>