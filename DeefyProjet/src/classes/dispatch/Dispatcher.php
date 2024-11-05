<?php

namespace deefyprojet\dispatch;
use \deefyprojet\action as ACT;

class Dispatcher{

    private string $action;

    public function __construct(){
        if (isset($_GET['action']))
            $this->action = $_GET['action'];
        else
            $this->action = '';
    }

    public function run() {
        $html = '';
        switch ( $this->action) {
            case 'playlist':
                $act = new ACT\DisplayPlaylistAction();
                $html = $act->execute();
                break ;

            case 'add-playlist' :
                $act = new ACT\AddPlaylistAction();
                $html = $act->execute();
                break ;

            case 'add-track' :
                $act = new ACT\AddPodcastTrackAction();
                $html = $act->execute();
                break ;

            case 'signin' :
                $act = new ACT\SigninAction();
                $html = $act->execute();
                break ;

            case 'register' :
                $act = new ACT\RegisterAction();
                $html = $act->execute();
                break ; 

            default :
                $act = new ACT\DefaultAction();
                $html = $act->execute();
                break;
        }
        $this->renderPage($html);
    }

    private function renderPage(string $html): void{
        echo <<<END
            <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <title>Deefy</title>
                </head>
                <body>
                    <h1>Deefy</h1>
                    <nav>
                        <ul>
                            <li><a href="main.php?action=default"> Accueil </a></li>
                            <li><a href="main.php?action=playlist"> Affiche playlist </a></li>
                            <li><a href="main.php?action=add-playlist"> Ajout playlist </a></li>
                            <li><a href="main.php?action=add-track"> Ajout piste </a></li>
                            <li><a href="main.php?action=signin"> Se connecter </a></li>
                            <li><a href="main.php?action=register"> S'inscrire </a></li>
                        </ul> 
                    </nav>
                    $html
                </body>
            </html>
            END;

    }
}