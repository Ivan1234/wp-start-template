<?php get_header(); ?>
<?php
while ( have_posts() ) : the_post(); ?>
    <div class="container-fluid">
        <div class="row">
            <?php the_content(); ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>