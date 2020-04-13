<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="./css/inscription_style.css" type="text/css" media="screen" />
	    <link rel="stylesheet" href="./css/header_style.css" type="text/css" media="screen" />
	    <link rel="stylesheet" href="./css/navig_style.css" type="text/css" media="screen" />
	    <link rel="stylesheet" href="./css/footer_style_2.css" type="text/css" media="screen" />
        <title>Connexion</title>
    </head>
	<body> 
	{include file='header.tpl'}
	{include file='navig.tpl'}
	<div class="container">      
		<form method="post">
		<h1>Connexion</h1>
		    
		    {if isset($ere_pseudo)}
		    <div>{$ere_pseudo}</div>
		    {/if}

		    <!--<label><b>Entrer Nom</b></label>-->
		    <div class="textbox">
		    <input type="text" placeholder="Nom" name="pseudo"required>
			</div>

		    {if isset($ere_mdp)}
		    <div>{$ere_mdp}</div>
		    {/if}
		    
		    <!--<label><b>Mot de passe</b></label>-->
		    <div class="textbox">
		    <input type="password" placeholder="Mot de passe" name="mdp" required>
			</div>

		    <button class="btn" type="submit" name="connect">Se connecter</button>

		</form>
	    </div>
	</body>
    
</html>