<?php
    $thumbnail_id = get_field('blog_default_thumbnail', 'option')['ID'];

    if(!empty(get_post_thumbnail_id())) $thumbnail_id = get_post_thumbnail_id();

    $feat_img = getIMG($thumbnail_id, 'lg');
    $permalink = get_the_permalink();
?>

<article class="post-card">
    <a class="post-card__thumb" href="<?php echo $permalink; ?>">
        <div class="positioner"><?php echo $feat_img; ?></div>
    </a>
    <div class="post-card__content">
        <h4 class="post-card__title"><?php the_title(); ?></h4>
        <p class="post-card__excerpt"><?php echo excerpt(30); ?></p>
        <a class="post-card__link" href="<?php echo $permalink; ?>">Read More</a>
    </div>
</article>