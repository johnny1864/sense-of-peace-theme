<?php get_header(); ?>

<section class="archive-content">
    <div class="container">

        <div class="blog-posts loadmore-container">

            <?php if( have_posts() ):
				while( have_posts() ): the_post();
					get_template_part('lib/parts/post-card');
				endwhile;

				else : ?>
            <h2>No Posts Found</h2>
            <?php endif; ?>

        </div>

        <?php if(have_posts()) get_template_part('lib/parts/loadmore'); ?>

    </div>
</section>

<?php get_template_part('lib/layout/flexible'); ?>

<?php get_footer(); ?>