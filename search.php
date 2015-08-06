<?php get_header(); ?>
<main role="main">
    <div class="container">
        <div class="row">
            <div class="ninecol">
                <div class="content">

                    <h1 class="term-search">Resultado da busca por <span class="term"><?php echo get_search_query(); ?></span></h1>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <div class="post">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endwhile; else: ?>
                        <div class="post">
                            <p>Não foram encontrados resultados para a busca.</p>
                        </div>
                    <?php endif; ?>

                </div> <!-- .content -->
            </div>
            <div class="threecol last">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
