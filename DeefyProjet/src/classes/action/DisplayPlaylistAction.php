<?php

namespace deefyprojet\action;

use deefyprojet\repository\DeefyRepository;
use \deefyprojet\render as RD;
use \deefyprojet\auth\AuthzProvider;

class DisplayPlaylistAction extends Action{

    public function execute () : string{

        if (isset($_SESSION['userId'])){
            if ($this->http_method === 'GET'){ 
                return <<<END
                        <form method="POST" action="?action=playlist">

                        <label for="id">ID de playlist recherché :</label><br>
                        <input type="number" name="id">
                        <button type="submit"> Chercher ma playlist</button>
                        </form>
                END;
            }
            else { //$this->http_method === 'POST'

                $html = "<div>Affichage de la playlist</div>";

                $id = filter_var($_POST['id']);

                

                if(AuthzProvider::autorisation($_SESSION['userId'],$id)){

                    $r = DeefyRepository::getInstance();
                    $pl = $r->findPlaylistById( $id );

                    if ($pl === null){
                        $html .= "<br><div>Playlist non trouvé</div>";
                    }
                    else{
                        $nomPl = $pl->name;
                        $html .= "<br><h3>$nomPl</h3>";
                        $tabTrack = $r->getTrackFromPlaylist($id);
                        foreach ($tabTrack as $track){
                            $render = new RD\AlbumTrackRenderer($track);
                            $ajoutHtml = $render->render(RD\Renderer::LONG);
                            $html .= "<br><div>$ajoutHtml</div>";
                        }
                    }
                    
                    return $html;
                }else{
                    return "<div>Playlist non trouvé</div>";
                }
            }
        }else{
            return "<div>Vous devez être connecter</div>";
        }
    }
}