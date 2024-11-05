<?php

namespace deefyprojet\render;

class AudioListRenderer implements Renderer {

    protected \deefyprojet\audio\lists\AudioList $list;

    public function __construct(\deefyprojet\audio\lists\AudioList $l){
        $this->list = $l;
    }

    public function render(string $type = "ye") : string{
        $res = "";
        $res = $res."<h1>{$this->list->name}</h1></br>";
        foreach( $this->list->tracks as $a){
            $track = new AlbumTrackRenderer($a);
            $res = $res."{$track->render(Renderer::COMPACT)}</br>";
        }
        $size = sizeof($this->list->tracks);
        $res = $res."{$size} tracks, {$this->list->duration} minutes of listening";
        return $res;
    }

}