<?php get_header(); ?>
<main role="main">
    <div id="conteudo" class="container">
        <header class="page-header">
            <?php if ( have_posts() ) : ?>
                <h1 class="term-search"><?php printf( __( 'Resultado da busca por: %s', 'snackwp' ), '<span clas"="term">' . get_search_query() . '</span>' ); ?></h1>
            <?php else : ?>
                <h1 class="term-search"><?php _e( 'Nenhum resultado encontrado', 'snackwp' ); ?></h1>
            <?php endif; ?>
        </header>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!-- Date -->
                <span class="date"><?php the_time('d/m/Y'); ?></span>

                <!-- Title -->
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                <!-- Post Thumbnail -->
                <?php if( has_post_thumbnail() ): ?>
                   <figure><?php echo snack_thumbnail( 500, 300, get_the_title(), true, 'minha-classe' ); ?></figure>
                <?php endif; ?>

                <!-- Excerpt -->
                <p class="excerpt"><?php echo get_the_excerpt(); ?></p>

            </article>
        <?php endwhile; else: ?>
            <div class="post">
                <p><?php _e( 'Não foram encontrados resultados para a busca. Por favor, tente novamente com uma palavra-chave diferente.', 'snackwp' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
        <?php get_sidebar(); ?>
    </div>
</main>
<?php get_footer(); ?>
