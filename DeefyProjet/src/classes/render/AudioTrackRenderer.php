<?php

namespace deefyprojet\render;

abstract class AudioTrackRenderer implements Renderer{
    protected \deefyprojet\audio\tracks\AudioTrack $track;

    public function __construct(\deefyprojet\audio\tracks\AlbumTrack $a){
        $this->track = $a;
    }

    public function render(string $selector) : string{
        switch( $selector){
            case Renderer::COMPACT:
                return $this->renderShort();
                break;
            case Renderer::LONG:
                return $this->renderFullScreen();
                break;
        }
    }

    protected function renderShort() : string {
        return "";
    }

    protected function renderFullScreen() : string {
        return "";
    }
}