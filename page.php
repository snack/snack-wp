<?php get_header(); ?>
<main role="main">
    <div class="container">
        <div class="row">
            <div id="conteudo" class="content">

                <h1 class="title"><?php the_title(); ?></h1>

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>

            </div>

            <!-- Sidebar -->
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>
