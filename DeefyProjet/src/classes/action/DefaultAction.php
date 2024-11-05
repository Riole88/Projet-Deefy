<?php

namespace deefyprojet\action;

class DefaultAction extends Action{

    public function execute () : string{
        if ($this->http_method === 'GET'){
            return "<div>Affichage de la page d'accueil dans le cas GET</div>
                    <form action='.' method='POST'>
                        <input type='text' name='nom'>
                        <input type='submit' value='Envoyer le formulaire'>
                    </form>
            ";
        }
        else {
            var_dump($_POST);
            return "<div>Affichage de la page d'accueil dans le cas POST</div>";
        }
    }

}