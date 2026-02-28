<?php
	$top_content = get_sub_field('top_content');
	$bottom_content = get_sub_field('bottom_content');
    $icon_blocks = get_sub_field('icon_blocks');
	$attr = buildAttr(array('id'=>$id,'class'=>$classList));
?>

<section <?php echo $attr; ?>>
    <div class="container container--md">
        <?php if(!empty($top_content)) : ?>
        <div class="top-content">
            <?php echo $top_content; ?>
        </div>
        <?php endif; ?>

        <?php if($icon_blocks) : ?>
        <div class="icon-text-blocks__blocks">
            <div class="lg:flex justify-center">
                <?php foreach ($icon_blocks as $block) : ?>
                    <div class="icon-text-blocks__block text-center flex flex-col justify-center items-center">
                        <?php if ( ! empty( $block['icon'] ) ) : ?>
                            <div class="icon-text-blocks__block-icon flex justify-center items-center">
                                <?php echo getIMG( $block['icon']['ID'] ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $block['title'] ) ) : ?>
                            <h5 class="icon-text-blocks__block-title">
                                <?php echo $block['title']; ?>
                            </h5>
                        <?php endif ?>
                        <?php if ( ! empty( $block['subtext'] ) ) : ?>
                            <span class="icon-text-blocks__block-subtext">
                                <?php echo $block['subtext']; ?>
                            </span>
                        <?php endif ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if(!empty($bottom_content)) : ?>
        <div class="bottom-content">
            <?php echo $bottom_content; ?>
        </div>
        <?php endif; ?>
    </div>
</section>