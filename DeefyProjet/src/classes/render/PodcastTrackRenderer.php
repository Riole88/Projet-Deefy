<?php

namespace deefyprojet\render;

class PodcastTrackRenderer implements Renderer{

    private AlbumTrack $track;

    public function __construct(AlbumTrack $a){
        $this->track = $a;
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