<?php

namespace deefyprojet\action;

use \deefyprojet\audio\lists as LS;
use \deefyprojet\render as RD;
use \deefyprojet\repository\DeefyRepository;
use \deefyprojet\auth\AuthnProvider;

class SigninAction extends Action{

    public function execute () : string{
        if ($this->http_method === 'GET'){ 
            return <<<END
                    <h2>Se connecter</h2>
                    <form method="POST" action="?action=signin">
                    Email: <input type='text' name='email'>
                    Mdp: <input type='text' name='mdp'>
                    <input type='submit' value='se connecter'>
                    </form>
            END;
        }
        else { //$this->http_method === 'POST'

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
            $mdp = $_POST['mdp'];
            
            AuthnProvider::signin($email, $mdp);

            $html = '<div>Vous êtes connecté en tant que </div>';
            $html .= $email;

            return $html;
        }
    }

}