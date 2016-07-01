<?php get_header(); ?>
<main class="main" role="main">
    <div class="row">

        <!-- Content -->
        <div id="conteudo" class="content">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div <?php post_class(); ?>>

                    <!-- Date -->
                    <span class="date"><?php the_time('d/m/Y'); ?></span>

                    <!-- Title -->
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                    <!-- Post Thumbnail -->
                    <?php if( has_post_thumbnail() ): ?>
                        <figure><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb-700x320'); ?></a></figure>
                    <?php endif; ?>

                    <!-- Excerpt -->
                    <p class="excerpt"><?php echo get_the_excerpt(); ?></p>

                </div>

            <?php endwhile; endif; ?>

            <?php echo snack_pagination(); ?>

        </div>

        <!-- Sidebar -->
        <?php get_sidebar(); ?>
    </div>
</main>
<?php get_footer(); ?>
