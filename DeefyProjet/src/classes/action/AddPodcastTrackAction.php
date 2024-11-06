<?php

namespace deefyprojet\action;

use \deefyprojet\audio\tracks as TK;
use \deefyprojet\render as RD;
use \deefyprojet\repository\DeefyRepository;


class AddPodcastTrackAction extends Action{

    public function execute () : string{
        if (isset($_SESSION['userId'])){
            if ($this->http_method === 'GET'){
                
                return <<<END
                        <form method="POST" action="?action=add-track" enctype="multipart/form-data">

                        <select name="choix" id="choix">
                            <option value="album">Album</option>
                            <option value="podcast">Podcast</option>
                        </select><br>
                        
                        <label for="titre">Titre :</label><br>
                        <input type="text" name="titre"><br>
                        

                        <label for="artiste">Artiste :</label><br>
                        <input type="text" name="artiste"><br>
                        

                        <label for="date">Date :</label><br>
                        <input type="number" name="date"><br>
                        

                        <label for="genre">Genre :</label><br>
                        <input type="text" name="genre"><br>
                        

                        <label for="duree">Duree :</label><br>
                        <input type="number" name="duree"><br>
                        

                        <label for="filePath">File Path :</label><br>
                        <input type="file" name="filePath" accept="audio/mpeg" required><br>

                        <label for="idPl">Id de la playlist :</label><br>
                        <input type="number" name="idPl"<br>
                        

                        <button type="submit"> Ajouter mon PodcastTrack</button>
                        </form>
                END;
            }
            else {//$this->http_method === 'POST'
                $html = "<h2>Etat de l'ajout</h2>";

                $titrePod = filter_var($_POST['titre'] , FILTER_SANITIZE_SPECIAL_CHARS);
                $artistePod = filter_var($_POST['artiste'] , FILTER_SANITIZE_SPECIAL_CHARS);

                $genrePod = filter_var($_POST['genre'] , FILTER_SANITIZE_SPECIAL_CHARS);
                //$filePathPod = filter_var($_POST['filePath'] , FILTER_SANITIZE_SPECIAL_CHARS);
                $idPl = filter_var($_POST['idPl']);

                $upload_dir = 'audio/';
                $filename = uniqid();
                $tmp = $_FILES['filePath']['tmp_name'] ;


                
                $tmp = $_FILES['filePath']['tmp_name'] ?? null;
                $error = $_FILES['filePath']['error'] ?? UPLOAD_ERR_NO_FILE;
                $type = $_FILES['filePath']['type'] ?? null;

                if ($error === UPLOAD_ERR_OK && $type === 'audio/mpeg') {
                    $dest = $upload_dir.$filename.'.mp3';
                    if (move_uploaded_file($tmp, $dest)) {
                        $html .= "Téléchargement terminé avec succès<br>";
                        $filePathPod = $dest;
                    } else {
                        $html .= "Téléchargement non valide<br>";
                    }
                } else {
                    $html .= "Échec du téléchargement ou type non autorisé<br>";
                }

                $r = DeefyRepository::getInstance();

                if($_POST['choix'] == "album"){
                    $res = new TK\AlbumTrack(
                        $titrePod,
                        $artistePod,
                        intval($_POST['date']),
                        $genrePod,
                        intval($_POST['duree']),
                        $filePathPod,
                        1,
                        $titrePod
                    );
                    $resultatMethode = $r->saveAlbumTrack($res, $idPl);
                }else{
                    $res = new TK\PodcastTrack(
                        $titrePod,
                        $artistePod,
                        $_POST['date'],
                        $genrePod,
                        $_POST['duree'],
                        $filePathPod 
                    );
                    $resultatMethode = $r->savePodcastTrack($res, $idPl);
                }

                
                if($resultatMethode == true){
                    $html .= "<div>Track sauvegardé dans la playlist</div>";
                }else{
                    $html .= "<div>Track non sauvegardé car la playlist est inexistante</div>";
                }
                
                return $html;
            }
        }else{
            return "<div>Vous devez être connecté pour ajouter une piste</div>";
        }
    }

}