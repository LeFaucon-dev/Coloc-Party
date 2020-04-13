<?php

class sub_membre{
	public $pseudo;
    private $mdp; // On récupère le mot de passe 
    private $confmdp; //  On récupère la confirmation du mot de passe
    public $valid;
    public $erpseudo;
    public $ermdp;

    function __construct($pseudo, $mdp, $confmdp, $valid){

        $this->pseudo = htmlentities(strtolower(trim($pseudo)));
    	$this->mdp = trim($mdp);
    	$this->confmdp = trim($confmdp);
	    $this->valid = $valid; 


        $DB=new connexionDB();

        if(empty($this->pseudo)){
            $this->valid = false;
            $this->erpseudo = ("Le nom d' utilisateur ne peut pas être vide");
        }     

        else{
            // On vérifit que le mail est disponible
            $req_pseudo = $DB->query("SELECT pseudo FROM membres WHERE pseudo = ?",
                array($this->pseudo));

            $req_pseudo = $req_pseudo->fetch();

            if ($req_pseudo != false){
                $this->valid = false;
                $this->erpseudo = "Déjà Inscrit";
            }
        }

        // Vérification du mot de passe
        if(empty($this->mdp)) {
            $this->valid = false;
            $this->ermdp = "Le mot de passe ne peut pas être vide";
        }

        elseif($this->mdp != $this->confmdp){
            $this->valid = false;
            $this->ermdp = "La confirmation du mot de passe ne correspond pas";
        }

        // Si toutes les conditions sont remplies alors on fait le traitement
        if($this->valid){

            $this->mdp = password_hash($this->mdp, PASSWORD_DEFAULT);

            // On insert nos données dans la table utilisateur
            $DB->insert("INSERT INTO membres(pseudo, mdp) VALUES (?, ?)", array($this->pseudo, $this->mdp));
        }
    }

}
?>