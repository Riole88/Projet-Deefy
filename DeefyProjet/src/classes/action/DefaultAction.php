<?php

namespace deefyprojet\action;

class DefaultAction extends Action{

    public function execute () : string{
        if ($this->http_method === 'GET'){
            return "<div>Bienvenue dans l'app Deefy, veuillez vous connecter pour voir, ajouter des playlist et ajouter des pistes</div>
                    
            ";
        }
        else {
            var_dump($_POST);
            return "<div>Affichage de la page d'accueil dans le cas POST</div>";
        }
    }

}