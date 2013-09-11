wordpress-boilerplate
=====================

Tema básico para iniciar um projeto em Wordpress baseado no [A2Boilerplate](http://https://github.com/a2comunicacao/A2boilerplate), e assim fazer as customizações de Menus, Widgets, Plugins, etc.

## Estrutura ##

* [CSS](https://github.com/a2comunicacao/A2boilerplate#css)
	* [SASS](https://github.com/a2comunicacao/A2boilerplate#sass)
* IN
	* `mobile_detect.php`
	* `scripts.php`
* [JS](#js)
	* LIBS
		* jQuery
		* Modernizr
		* Respond
	* `scripts.js`
* `header.php`
* `footer.php`
* `index.php`
* `page.php`
* `single.php`
* `category.php`
* `sidebar.php`
* `functions.php`




## Como usar ##

Clonar o repositório para a pasta de temas do wordpress: 
> /wp-content/themes/

    git clone https://github.com/a2comunicacao/wordpress-boilerplate.git

## Adicionando novos templates de páginas ##
Criar um novo arquivo dentro da pasta do tema, ex:  
> `nome-do-template.php`

Adicionar o código abaixo no seu tmeplate:

    <?php     
    	/* Template Name: Nome do template */    
    	get_header();     
    ?>
    	//Conteúdo
    <?
		get_footer();
	?>



