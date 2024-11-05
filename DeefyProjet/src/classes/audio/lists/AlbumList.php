<?php

namespace deefyprojet\audio\lists;

class AlbumList extends AudioList{

    private string $artist;
    private string $year;

    public function __construct(string $name, string $artist, string $year, array $tracks){
        parent::__construct($name, $tracks);
        $this->artist = artist;
        $this->year = year;
    }

    public function setArtist(string $artist){
        $this->artist = $artist;
    }

    public function setYear(string $year){
        $this->year = $year;
    }
}