<?php get_header(); ?>
<main role="main">
    <div class="container">
        <div class="row">
            <div class="ninecol">
                <div class="content">
                    <h1><?php the_title(); ?></h1>

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>

                </div> <!-- .content -->
            </div>
            <div class="threecol last">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
