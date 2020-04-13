<!DOCTYPE html>
<html lang="fr">
    <head>
    	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/accueil_style.css" type="text/css" media="screen" /> 
        <title>Roue Des Services</title>
    </head>

    <body>
    {include file='header.tpl'}
    {include file='navig.tpl'}
    <div class="container">
        {if isset($SESSION)}
            <h1>Bonjour {$pseudo} sur Coloc'Party !</h1>
                <img src="images/{$name_pic}.png"/>
        {else}
            <h1>Roue Des Services !</h1>
            <img src="images/{$name_pic}.png"/>
        {/if}
    </div>
    </body>

</html>


