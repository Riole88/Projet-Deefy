<?php

namespace deefyprojet\audio\tracks;

class PodcastTrack extends AudioTrack{

    public function __construct(string $title, string $artist, int $year, string $genre, int $durationSec, string $filePath){
        parent::__construct($title, $artist, $year, $genre, $durationSec, $filePath);
    }

    public function setArtist(string $a) : void {
        $this->artist = $a;
    }

    public function setGenre(string $g) : void {
        $this->genre = $g;
    }

    public function setDuration(int $s) : void {
        if($s >= 0){
            $this->durationSec = $s;
        }
       
    }

    public function __get(string $attr) : mixed{
        if(property_exists($this,$attr)){
            return $this->$attr;
        } else {
            throw new Exception("attribut $attr inexistant");
        }
    }
}