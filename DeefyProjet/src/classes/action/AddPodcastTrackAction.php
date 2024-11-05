<?php

namespace deefyprojet\action;

use \deefyprojet\audio\tracks as TK;
use \deefyprojet\render as RD;
use \deefyprojet\repository\DeefyRepository;


class AddPodcastTrackAction extends Action{

    public function execute () : string{
        if ($this->http_method === 'GET'){
            
            return <<<END
                    <form method="POST" action="?action=add-track" enctype="multipart/form-data">
                    
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
                    

                    <button type="submit"> Ajouter mon PodcastTrack</button>
                    </form>
            END;
        }
        else {//$this->http_method === 'POST'
            $html = "<div>Ajout dans playlist dans le cas POST</div>";

            $titrePod = filter_var($_POST['titre'] , FILTER_SANITIZE_SPECIAL_CHARS);
            $artistePod = filter_var($_POST['artiste'] , FILTER_SANITIZE_SPECIAL_CHARS);

            $genrePod = filter_var($_POST['genre'] , FILTER_SANITIZE_SPECIAL_CHARS);
            $filePathPod = filter_var($_POST['filePath'] , FILTER_SANITIZE_SPECIAL_CHARS);


            $upload_dir = 'audio/';
            $filename = uniqid();
            $tmp = $_FILES['filePath']['tmp_name'] ;

            var_dump($_FILES);

            
            $tmp = $_FILES['filePath']['tmp_name'] ?? null;
            $error = $_FILES['filePath']['error'] ?? UPLOAD_ERR_NO_FILE;
            $type = $_FILES['filePath']['type'] ?? null;

            if ($error === UPLOAD_ERR_OK && $type === 'audio/mpeg') {
                $dest = $upload_dir.$filename.'.mp3';
                if (move_uploaded_file($tmp, $dest)) {
                    $html .= "Téléchargement terminé avec succès<br>";
                } else {
                    $html .= "Téléchargement non valide<br>";
                }
            } else {
                $html .= "Échec du téléchargement ou type non autorisé<br>";
            }



            $filePathPod = $dest;

            $_SESSION['monPodcastTrack'] = new TK\PodcastTrack(
                $titrePod,
                $artistePod,
                $_POST['date'],
                $genrePod,
                $_POST['duree'],
                $filePathPod 
            );

            var_dump($_SESSION['monPodcastTrack']);
            
            return $html;
        }
    }

}