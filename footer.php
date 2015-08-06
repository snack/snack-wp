<footer class="footer container" role="contentinfo">
    <div class="row">
        <div class="fourcol">

            <!-- Logo footer -->
            <div class="logo-footer">
                <a class="hover" href="<?php echo home_url( '/' ); ?>" title="Campanha">
                    <img src="<?php echo get_template_directory_uri(); ?>/build/img/" alt="Logo Campanha">
                </a>
            </div>

        </div>
        <div class="fourcol last">

            <!-- Social networks -->
            <div class="social-media social-small badge-small">
                <a href="https://www.facebook.com/pages/Atlantic-Energias-Renov%C3%A1veis/200023213374597" class="social-button social-facebook" alt="Compartilhar via Facebook"><i class="fa fa-facebook"></i></a>
                <a href="https://www.linkedin.com/company/atlantic-energias-renov-veis-s-a" class="social-button social-linkedin" alt="Compartilhar via Linkedin"><i class="fa fa-linkedin"></i></a>
                <a href="#" class="social-button social-twitter" alt="Compartilhar via Twitter"><i class="fa fa-twitter"></i></a>
                <a href="https://pinterest.com/pin/create/button/?url=IMAGEM-AQUI&media=URL-AQUI&description=DESC-AQUI" class="social-button social-pinterest" alt="Compartilhar via Pinterest"><i class="fa fa-youtube"></i></a>
            </div>

            <p class="back-top"><a href="#">Voltar ao topo</a></p>

        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
<?php ob_end_flush(); ?>
