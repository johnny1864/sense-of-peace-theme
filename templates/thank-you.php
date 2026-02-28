<?php /* Template Name: Thank You */  
get_header(); 

$section = get_field('thank_you');
$bg_image_ID = $section['bg_image']['ID'];
$heading = $section['heading'] ?? get_the_title();
$feat_img = wp_get_attachment_image_url($bg_image_ID, 'full');

?>

<?php if( have_posts() ):
	while( have_posts() ): the_post();?>
	<section 
    class="thank-you" 
    <?php if(!empty($feat_img)): ?>
        style="background-image: url(<?php echo $feat_img; ?>)"
    <?php endif; ?>
    >
        <?php echo getSVG('curve'); ?>
        <div class="container relative">
            <img class="thank-you__shadow desk-only" src="http://linen-hare-191650.hostingersite.com/wp-content/uploads/2026/01/text-shadow-e1767596693846.png" alt="">
            <div class="thank-you__wrapper text-center relative">
                
                <h1 class="thank-you__title" data-aos="fade-up" data-aos-delay="100">
                    <?php echo $heading; ?>
                </h1>
                <div class="thank-you__content" data-aos="fade-up" data-aos-delay="300">
                    <?php if(!empty($section['content'])) echo $section['content']; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
	endwhile;
endif; ?>

<?php get_footer(); ?>