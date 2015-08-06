<?php get_header(); ?>
<main role="main">
    <div class="container">
        <div class="row">
            <div class="ninecol">
                <div class="content">

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <!-- Date -->
                        <span class="date"><?php the_time('d/m/Y'); ?></span>

                        <!-- Title -->
                        <h1 class="title"><?php the_title(); ?></h1>

                        <!-- Post Thumbnail -->
                        <?php if( has_post_thumbnail() ): ?>
                           <figure><?php the_post_thumbnail('thumb-700x320'); ?></figure>
                        <?php endif; ?>

                        <!-- Excerpt -->
                        <p class="excerpt"><?php echo get_the_excerpt(); ?></p>

                        <!-- Vídeo Destacado -->
                        <?php if ( function_exists('video_destacado') ): ?>
                            <div class="video-featured"><?php video_destacado(); ?></div>
                        <?php endif; ?>

                        <!-- Content -->
                        <article><?php the_content(); ?></article>

                        <!-- Categories -->
                        <div class="categories">

                        </div>

                    <?php endwhile; endif; ?>

                    <!-- Toolbox -->
                    <?php include __DIR__ . '/build/in/toolbox.php'; ?>

                    <!-- Related Posts -->
                    <?php wp_related_posts()?>

                    <!-- Comments -->
                    <?php comments_template( '', true ); ?>

                </div> <!-- .content -->
            </div>
            <div class="threecol last">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
