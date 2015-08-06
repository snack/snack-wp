<form id="form-search" role="search" method="get" class="form form-search" action="<?php echo home_url( '/' ); ?>">
    <fieldset>
        <legend class="sr-only">Formulário de Busca</legend>
        <label class="form-label" for="search">
            <span class="sr-only">Pesquisar por:</span>
            <input id="search" type="search" class="input" placeholder="O que você procura?" name="s" accesskey="2" list="options" />
        </label>
        <input type="submit" value="ok" class="btn btn-primary" />
    </fieldset>
</form>
