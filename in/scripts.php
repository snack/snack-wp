<!-- VERIFICAR SE NÃO É MOBILE -->
<?php if(!$isMobile): ?>

	<!-- jQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

	<!-- scripts.js -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>

	<!-- wp_footer do wordpress -->
	<?php wp_footer();  ?>
	
<?php else:  ?>
<!-- SCRIPTS PARA MOBILE SÃO CARREGADOS AQUI -->


<?php endif; ?>


<!-- Google Analytics -->
<script>
var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>