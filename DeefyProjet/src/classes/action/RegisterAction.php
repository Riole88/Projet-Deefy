<?php

namespace deefyprojet\action;

use \deefyprojet\audio\lists as LS;
use \deefyprojet\render as RD;
use \deefyprojet\repository\DeefyRepository;
use \deefyprojet\auth\AuthnProvider;

class RegisterAction extends Action{

    public function execute () : string{
        if ($this->http_method === 'GET'){ 
            return <<<END
                    <h2>Enregistrer un nouvel utilisateur</h2>
                    <form method="POST" action="?action=register">
                    Email: <input type='text' name='email'>
                    Mdp: <input type='text' name='mdp'>
                    <input type='submit' value='S inscrire'>
                    </form>
            END;
        }
        else { //$this->http_method === 'POST'

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
            $mdp = filter_var($_POST['mdp'], FILTER_SANITIZE_EMAIL);
            
            AuthnProvider::register($email, $mdp);

            return '<div>Vous êtes inscrit, veuillez vous connecter pour la suite</div>';
        }
    }

}