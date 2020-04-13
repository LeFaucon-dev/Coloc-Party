<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/inscription_style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="./css/navig_style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="./css/header_style.css" type="text/css" media="screen" /> 
        <link rel="stylesheet" href="./css/footer_style_2.css" type="text/css" media="screen" /> 
        <title>Inscription</title>
    </head>
    
    <body>
    {include file='header.tpl'}
    {include file='navig.tpl'}
	<div class="container">
        <form method="post">
		<h1>Inscription</h1>
			{if isset($er_pseudo)}
			<div>{$er_pseudo}</div>
			{/if}
		
			<label><b>Pseudo</b></label>
			<div class="textbox">
			<input type="text" placeholder="Votre pseudo" name="pseudo" required>   
			 </div>

			{if isset($er_mdp)}
			<div>{$er_mdp}</div>
			{/if}
			
			<label><b>Mot de Passe</b></label>
			<div class="textbox">
			<input type="password" placeholder="Mot de passe" name="mdp" required>
		    </div>
		    <div class="textbox">
			<input type="password" placeholder="Confirmer le mot de passe" name="confmdp" required>
		    </div>

		   
			<button class="btn" type="submit" name="register">Envoyer</button>

            </form>
	</div>

    </body>
    
</html>