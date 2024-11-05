<?php

namespace deefyprojet\render;

class AlbumTrackRenderer extends AudioTrackRenderer {

    public function __construct(\deefyprojet\audio\tracks\AlbumTrack $a){
        parent::__construct($a);
    }

    protected function renderShort() : string {
        return "{$this->track->title}</br>";
    }

    public function __get(string $attr){
        if(property_exists($this,$attr)){
            return $this->$attr;
        } else {
            throw new ArgumentException("attribut $attr inexistant");
        }
    }

    protected function renderFullScreen() : string {
        return "-------------------------</br>{$this->track->title} <audio controls src='{$this->track->filePath}'></audio> </br>-------------------------</br>";
    }

}