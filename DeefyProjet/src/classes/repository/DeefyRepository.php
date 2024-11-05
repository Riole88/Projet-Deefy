<?php

namespace deefyprojet\repository;

use \deefyprojet\audio\lists\Playlist;
use \deefyprojet\audio\tracks\AlbumTrack;
use \deefyprojet\audio\tracks\PodcastTrack;

class DeefyRepository{
    private \PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $config = [ ];

    private function __construct(array $conf) {
        $this->pdo = new \PDO($conf['dsn'], $conf['user'], $conf['pass'],
        [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }


    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new DeefyRepository(self::$config);
        }
        return self::$instance;
    }


    public static function setConfig(string $file) {
        $conf = parse_ini_file($file);
        if ($conf === false) {
            throw new \Exception("Error reading configuration file");
        }

        $driver = $conf['driver'];
        $host = $conf['host'];
        $database = $conf['database'];


        $dsn = "$driver:host=$host;dbname=$database";


        self::$config = [ 
            'dsn' => $dsn, 
            'user'=> $conf['username'], 
            'pass'=> $conf['password']
        ];
    }


    public function findPlaylistById(int $id): ?Playlist {
        $stmt = self::$instance->pdo->prepare('SELECT id, nom FROM playlist WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if ($data) {
            $playlist = new Playlist($data['nom']);
        } 
        return $playlist;
    }


    public function saveEmptyPlaylist(Playlist $pl, int $idUser): Playlist {
        $stmt = $this->pdo->prepare("INSERT INTO playlist (nom) VALUES (:nom)");
        $stmt->bindParam(':nom', $pl->getNom(), \PDO::PARAM_STR);
        $stmt->execute();

        $lastInsertId = (int)$this->pdo->lastInsertId();

        $stmt2 = $this->pdo->prepare("INSERT INTO user2playlist (id_user, id_pl)  VALUES (?, ?)");
        $stmt2->execute([$idUser, $lastInsertId]);

        return $pl;
    }


    public function getPasswd(string $email): string {
        $stmt = self::$instance->pdo->prepare('SELECT passwd FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $res = $stmt ->fetchAll();
        $mdp = $res[0]['passwd'];

        var_dump($stmt->fetchAll());

        return $mdp;
    }

    public function getTrackFromPlaylist(int $id): array{
        $stmt = self::$instance->pdo->prepare('SELECT id_track FROM playlist2track WHERE id_pl = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();

        $stmt2 = self::$instance->pdo->prepare('SELECT titre,genre,artiste_album,duree,annee_album,filename,numero_album,titre_album FROM track WHERE id = ?');

        $tabTrackRes = array();

        foreach ($data as $ligne) {
            $stmt2->execute([$ligne['id_track']]);
            $data2 = $stmt2->fetch();
            $track = new AlbumTrack($data2['titre'],$data2['artiste_album'],$data2['annee_album'],$data2['genre'],$data2['duree'],$data2['filename'],$data2['numero_album'],$data2['titre_album']);
            array_push($tabTrackRes,$track);
        }
        return $tabTrackRes;
    }

    public function getPDO(){
        return $this->pdo;
    }

}