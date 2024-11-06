<?php

namespace deefyprojet\action;

use \deefyprojet\audio\lists as LS;
use \deefyprojet\render as RD;
use \deefyprojet\repository\DeefyRepository;

class AddPlaylistAction extends Action{

    public function execute () : string{

        if (isset($_SESSION['userId'])){
            if ($this->http_method === 'GET'){ 
                return <<<END
                        <h2>Ajouter une playlist</h2>
                        <form method="POST" action="?action=add-playlist">
                        <input type="text" name="nom">
                        <button type="submit"> Ajouter ma playlist</button>
                        </form>
                END;
            }
            else { //$this->http_method === 'POST'
                $html = "<div>Ajout dans playlist dans le cas POST</div>";

                $nomPlayList = filter_var($_POST['nom'] , FILTER_SANITIZE_SPECIAL_CHARS);
                $pl = new LS\Playlist($nomPlayList,$tab=[]); 

                $_SESSION['maplaylist'] = $pl;

                $r = DeefyRepository::getInstance();
                $pl = $r->saveEmptyPlaylist($pl, $_SESSION['userId']);

                $rendu = new RD\AudioListRenderer($_SESSION['maplaylist']);
                
                $html .= $rendu->render(RD\Renderer::COMPACT);
                
                return $html;
            }
        }else{
            return "<div>Vous devez être connecté pour ajouter une playlist</div>";
        }
    }

}