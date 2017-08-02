<?php get_header(); ?>
<main class="main">
    <div id="conteudo" class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <span class="date"><?php the_time('d/m/Y'); ?></span>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php if( has_post_thumbnail() ): ?>
            <figure><?php echo snack_thumbnail( 500, 300, get_the_title(), true, 'minha-classe' ); ?></figure>
            <?php endif; ?>
            <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
        </article>
        <?php endwhile; endif; ?>
        <?php echo snack_pagination(); ?>
        <?php get_sidebar(); ?>
    </div>
</main>
<?php get_footer(); ?>
