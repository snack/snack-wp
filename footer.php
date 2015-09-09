<footer class="footer" role="contentinfo">
    <div class="row">

        <!-- Logo footer -->
        <div class="logo-footer">
            <a class="hover" href="<?php echo home_url( '/' ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/build/img/" alt="">
            </a>
        </div>

    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
<?php ob_end_flush(); ?>
