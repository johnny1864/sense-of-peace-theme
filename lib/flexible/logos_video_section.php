<?php
$logos = get_sub_field( 'logos' );
$heading = get_sub_field('heading');
$video_iframe = get_sub_field('video_iframe');
$cover_image = get_sub_field('video_cover_image');
$cta = get_sub_field('cta');
$attr = buildAttr( array( 'id' => $id, 'class' => $classList ) );
?>

<div <?php echo $attr; ?>> 
    <div class="wave-mobile md:hidden">
        <?php echo getSVG('mobile-wave'); ?>
    </div>
    <div class="wave-hide-mobile hidden md:block">
        <?php echo getSVG('wave'); ?>
    </div>
    <?php if ( $logos ) : ?>  
        <div class="container logos-slider__wrapper relative">
            <div class="logos-slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach ( $logos as $logo ) : ?>
                        <div class="swiper-slide">
                            <div class="flex justify-center items-center h-full logos-slider__logo">
                            <?php echo getIMG( $logo['ID'] ); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    <?php endif; ?>

    <section class="video-section">
     <div class="container">
        <?php if(!empty($heading)) : ?>
            <h2 class="text-center video-section__title">
            <?php echo $heading; ?>
            </h2>
        <?php endif; ?>

        <?php if(!empty($video_iframe)) : ?>
            <div class="video-section__iframe video-embed relative">
                <?php echo $video_iframe; ?>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $cta ) ) : ?>
                <div class="text-center video-section__cta">
                    <a
                        class="btn"
                        href="<?php echo esc_url( $cta['url'] ); ?>"
                        target="<?php echo esc_attr( $cta['target'] ); ?>"
                    >
                        <?php echo esc_html( $cta['title'] ); ?>
                    </a>
                </div>
            <?php endif; ?>
        
     </div>
    </section>
</div>