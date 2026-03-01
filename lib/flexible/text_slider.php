<?php
    $bg_image = get_sub_field('background_image');
    $bg_image = getIMG($bg_image['ID'], 'xxl', true);
    $heading = get_sub_field('heading');
	$top_content = get_sub_field('top_content');
	$bottom_content = get_sub_field('bottom_content');
    $blocks = get_sub_field('text_blocks');
	$attr = buildAttr(array('id'=>$id,'class'=>$classList));
?>

<section <?php echo $attr; ?> <?php if(!empty($bg_image)) echo $bg_image; ?>>
    <div class="container">
        <div class="text-slider__box text-center relative">
            <?php if(!empty($top_content)) : ?>
                <div class="text-slider__top-content">
                    <?php echo $top_content; ?>
                </div>
            <?php endif; ?>

            <?php if($icon_blocks) : ?>
                <div class="text-slider__slider swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($blocks as $block) : ?>
                            <div class="swiper-slide">
                                <div class="text-slider__card mx-auto">
                                    <?php if(!empty($block['text'])) echo $block['text']; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-prev desk-only"></div>
                    <div class="swiper-button-next desk-only"></div>
                    <div class="swiper-pagination"></div>
                </div>
            <?php endif; ?>

            <?php if(!empty($bottom_content)) : ?>
                <div class="text-slider__bottom-content">
                    <?php echo $bottom_content; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>