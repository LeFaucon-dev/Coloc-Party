<?php
    session_start();

    include('bd/connexionDB.php'); 
    include('smarty/libs/Smarty.class.php');
    include('php/co_membre.php');
    include('php/sub_membre.php');

   

    $smarty = new Smarty();
	// S'il y a une session alors on ne retourne plus sur cette page
    if (isset($_SESSION['id'])){
    	$smarty->assign('SESSION', $_SESSION['id']);
        $smarty->assign('pseudo', $_SESSION['pseudo']);
    	$menu = array( 
    		'Accueil' => '?page=acceuil',
    		'Deconnexion' => '?page=deconnexion',
    		'Courses' => '?page=courses',
	    	'Divertissements' => '?page=div',
	    	'Roues Des Services' => '?page=RDS');
    }
    else{
    	$menu = array( 
		'Accueil' => '?page=acceuil',
	    'Inscription' => '?page=inscription',
	    'Connexion' => '?page=connexion',
		'Roues Des Services' => '?page=RDS');
   }




    if(isset($_GET["page"])){
        $page = htmlspecialchars($_GET["page"]); // On recupere sa valeur
        if (($page=='connexion') and (empty($_SESSION['id']))) {
    	// Si la variable "$_Post" contient des informations alors on les traitres
		    if(!empty($_POST)){
		        extract($_POST);
		        $valid = true;

		        if (isset($_POST['connect'])){
		            $membre = new co_membre($_POST['pseudo'], $_POST['mdp'], $valid);   

		            if((isset($membre->ermail)) or (isset($membre->ermdp))){
		                $smarty->assign('ere_pseudo',$membre->ermail);
		                $smarty->assign('ere_mdp',$membre->ermdp);
		            }
		            else{
		            	 // S'il y a un résultat alors on va charger la SESSION de l'utilisateur en utilisateur les variables $_SESSION
				        if ($membre->valid==true){
				             // id de l'utilisateur unique pour les requêtes futures
				            $_SESSION['pseudo'] = $membre->pseudo;
				            $_SESSION['id'] = $membre->id;
				            header("Location: ?page=accueil");

				        }
		  		    }
		               
		        }
		    }
		    $smarty->assign('menu', $menu);
		    $smarty->display('connexion.tpl'); 
		}
		elseif (($page=='inscription') and (empty($_SESSION['id']))) {
			if(!empty($_POST)){
		        extract($_POST);
		        $valid = true;

	        // On se place sur le bon formulaire grâce au "name" de la balise "input"
		        if (isset($_POST['register'])){
		            $membre = new sub_membre($_POST['pseudo'],$_POST['mdp'],$_POST['confmdp'], $valid);
		            
		            if((isset($membre->erpseudo)) or (isset($membre->ermdp))){
		                $smarty->assign('er_pseudo',$membre->erpseudo);
		                $smarty->assign('er_mdp',$membre->ermdp);
		            }
		            else{
		           		header("Location: ?page=accueil");
		            }
		        }
    		}	
    	$smarty->assign('menu', $menu);
    	$smarty ->display('inscription.tpl');
		}
		elseif (($page=='deconnexion') and (isset($_SESSION['id']))){
			session_destroy();
    		header("Location: ?page=accueil"); // Ici il faut mettre la page sur lequel l'utilisateur sera redirigé.
			exit;
		}
		//Recherche par filtre
		elseif($page=='filtre'){ // debut elseif
        	$DB=new connexionDB();
			$meridsql = $DB->query("SELECT code, nom FROM meridien ");
			$meridsql = $meridsql->fetchAll();
			$smarty->assign('meridien', $meridsql);
			
			if(!empty($_POST)){
        		extract($_POST);
        	
        		if (isset($_POST['sch_filtre'])){
         			if(!empty($merid)){
         				$result = new rec_filt($merid,$patho,$carac);
         				if(!empty($result->result_filt)){
         					$smarty->assign('result', $result->result_filt);
         				}
         				else{
         					$no_result['desc']='PAS DE RESULTATS';
         					$result_filt1= array();
         					$result_filt2= array();
         					array_push($result_filt2,$no_result);
         					array_push($result_filt1,$result_filt2);
         					$smarty->assign('result', $result_filt1);
         				}
         			}
         		}
        	}
        	$smarty->assign('menu', $menu);
        	$smarty->display('rec_filtre.tpl');
		}// fin elseif

		// Barre de recherche
		/*elseif($page=='courses'){
			// ajouter ajout des courses
			$courses = new display_add_courses();

			if isset($_SESSION['id']) {
				if( (isset($_POST["s"])) and ($_POST["s"] == "add") ){
					$_POST["items"] = htmlspecialchars($_POST["items"]); //pour sécuriser le formulaire contre les intrusions html
			 		$items = $_POST["items"];
			 		$items = trim($items); //pour supprimer les espaces dans la requête de l'internaute
			 		$items = strip_tags($items); //pour supprimer les balises html dans la requête

			 		if (isset($items)){
			 			$courses->add($items);
	  				}
	  			}
	  		}

	  	$smarty->assign('results', $disp_course->res_courses);
		$smarty->assign('menu', $menu);
		$smarty->display('display_add_courses.tpl');
 		
  		$smarty->assign('menu', $menu);
  		$smarty->display('disp_search_bar.tpl');
		}*/

		// WEB service API calculatrice
		elseif($page=='RDS'){
		 	$name_pic = date("Ymd");
		 	$smarty->assign('name_pic', $name_pic);
		 	$smarty->assign('menu', $menu);
			$smarty->display('RDS.tpl');
		}
		else { 
			// On donne une valeur par defaut à $page
			$smarty->assign('menu', $menu);
			$smarty->display('accueil.tpl');
		}
	}
    else { 
        // On donne une valeur par defaut à $page
        $smarty->assign('menu', $menu);
        $smarty->display('accueil.tpl');
    }
?>