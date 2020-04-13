<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8">
		<title>Courses</title>
		<link rel="stylesheet" href="./css/header_style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="./css/navig_style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="./css/footer_style_2.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="./css/search_bar_style.css" type="text/css" media="screen" />
	</head>
	
<body>
{include file='header.tpl'}
{include file='navig.tpl'}
	<div class="container">
	<form method = "post">
	  	{if isset($SESSION)}
		   <input id="add_box" type = "text" name = "items">
		   <br>
		   <input id="submit_box" type = "submit" name = "s" value = "add">
		{else}
			<h1>Vous devez etre connecter pour acceder a la barre d'ajout</h1>
		{/if}
	</form>
	</div>
	<div class="result_container">
		{if isset($valid) and $valid==true}
			{foreach $response as $Sympt}
                  <p id="result_search"><b>Symptome :</b> {$Sympt['desc']}</p>
            {/foreach}
		{elseif isset($valid) and $valid==false }
			<p id="error_search"><b>{$er_response}</b></p>
		{/if}
	</div>
	{include file='footer_2.tpl'}
</body>
    
</html>























