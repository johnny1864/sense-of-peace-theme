<?php
	$invert = get_sub_field('reverse');
	$content = get_sub_field('content');
	$image = get_sub_field('image');
    $cta = get_sub_field('cta');
    $attr = buildAttr(array('id'=>$id,'class'=>$classList));
?>

<section <?php echo $attr; ?>>
    <img class="image-content__bg-graphic" src="https://wheat-gazelle-627237.hostingersite.com/wp-content/uploads/2026/03/image-content-bg.png" alt="">
    <div class="container">
        <div class="row <?php if($invert) echo 'row--reverse'; ?>">
            <div class="col col--left">
                <div class="image-content__img">
                    <?php if(!empty($image)) : ?>
                        <?php echo getIMG($image['ID'], 'xl'); ?>
                    <?php endif; ?>
                </div> 
            </div>

            <div class="col col--right">
                <div class="image-content__content text-center lg:text-left">
                    <?php if(!empty($content)) echo $content; ?>
                </div>  
            </div>
        </div>
    </div>
</section>