<?php global $global, $site_logo;
    $footer = get_field('footer', 'option');
    $footer_content = $footer['footer_content'];
    if(!empty($footer['site_logo'])) $site_logo = getIMG( $footer['site_logo']['ID'], 'md', false, array('alt' => get_bloginfo( 'name' ), 'lazy' => false));

    $footer_banner = $footer['footer_banner'];
?>

</main>

<div class="gfooter__banner section">
    <div class="container">
        <div class="flex items-center justify-around gap-5">
            <div class="gfooter__banner-image w-1/3">
                <?php if($footer_banner['logo_1']) : ?>
                    <?php echo getIMG($footer_banner['logo_1']['ID']) ?>
                <?php endif; ?>
            </div>
            <div class="gfooter__banner-image w-1/3">
                <?php if($footer_banner['logo_2']) : ?>
                    <?php echo getIMG($footer_banner['logo_2']['ID']) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<footer class="gfooter">
    <div class="container">
        <div class="gfooter__content text-center">
            <?php 
                if(!empty($footer_content)) {
                    echo $footer_content;
                }
            ?>
        </div>
    </div>

    <div class="gfooter__bottom">
        <div class="container">
            <div class="wrapper text-center">
                <?php echo getSocialLinks(); ?>
                <div class="gfooter__copy">
                    <p><a href="https://www.robeksfranchise.com/privacy/">Privacy Policy</a> | <a href="https://www.robeksfranchise.com/terms-of-use/" data-type="link" data-id="https://www.robeksfranchise.com/terms-of-use/">Terms of Use</a></p>
                    <p class="copy">&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
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

<?php echo get_field('body_scripts_bottom', 'option'); ?>
</body>

</html>