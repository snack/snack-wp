<?php get_header(); ?>
<main role="main">
    <div id="conteudo" class="container">
        <!-- Content -->
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <!-- Date -->
                    <span class="date"><?php the_time('d/m/Y'); ?></span>

                    <!-- Title -->
                    <h1 class="title"><?php the_title(); ?></h1>

                    <!-- Post Thumbnail -->
                    <?php if( has_post_thumbnail() ): ?>
                       <figure><?php echo snack_thumbnail( 500, 300, get_the_title(), true, 'minha-classe' ); ?></figure>
                    <?php endif; ?>

                    <!-- Excerpt -->
                    <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                </header>

                <div class="entry-content"><?php the_content(); ?></div>
                
                <footer class="entry-footer">
                    <!-- Categories -->
                    <div class="categories col-12">

                    </div>

                    <!-- Social Share -->
                    <?php snack_social_share(); ?>

                    <!-- Related Post -->
                    <?php snack_related_posts(); ?>
                </footer>
            </article>
        <?php endwhile; endif; ?>
        

        <!-- Sidebar -->
        <?php get_sidebar(); ?>
    </div>
</main>
<?php get_footer(); ?>
