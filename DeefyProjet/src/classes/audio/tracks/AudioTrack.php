<?php   

namespace deefyprojet\audio\tracks;

abstract class AudioTrack {

    protected string $title = "";
    protected string $artist = "";
    protected int $year = 0;
    protected string $genre = "";
    protected int $durationSec = 0;
    protected string $filePath = "";

    public function __construct(string $title, string $artist, int $year, string $genre, int $durationSec, string $filePath){
        $this->title = $title;
        $this->artist = $artist;
        $this->year = $year;
        $this->genre = $genre;
        $this->durationSec = $durationSec;
        $this->filePath = $filePath;
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

    function __toString() : string {
        return json_encode(get_object_vars($this));
    }

}