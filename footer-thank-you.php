<?php global $global, $site_logo;
    $footer = get_field('footer', 'option');
    $footer_content = $footer['footer_content'];
    if(!empty($footer['site_logo'])) $site_logo = getIMG( $footer['site_logo']['ID'], 'md', false, array('alt' => get_bloginfo( 'name' ), 'lazy' => false));
?>

</main>

<footer class="gfooter">
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

<?php wp_footer(); ?>

<?php echo get_field('body_scripts_bottom', 'option'); ?>
</body>

</html>