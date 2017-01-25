<?php get_header(); ?>
<main role="main">
    <div id="conteudo" class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php the_title( '<h1 class="title">', '</h1>' ); ?>

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; endif; ?>
        </article>
        <!-- Sidebar -->
        <?php get_sidebar(); ?>
    </div>
</main>
<?php get_footer(); ?>
