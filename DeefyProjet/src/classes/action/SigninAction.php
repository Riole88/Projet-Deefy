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
                    <form method="POST" action="?action=signin">
                    Email: <input type='text' name='email'>
                    Mdp: <input type='text' name='mdp'>
                    <input type='submit' value='se connecter'>
                    </form>
            END;
        }
        else { //$this->http_method === 'POST'
            
            var_dump($_POST);

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
            $mdp = $_POST['mdp'];
            
            AuthnProvider::signin($email, $mdp);

            return '<div>Se connecter dans le cas POST</div>';
        }
    }

}