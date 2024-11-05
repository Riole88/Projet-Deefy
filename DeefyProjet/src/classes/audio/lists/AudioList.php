<?php

namespace deefyprojet\audio\lists;

class AudioList {

    protected int $id;

    protected string $name;
    protected int $duration;
    protected array $tracks;

    public function __construct(string $name, array $tracks = []){
        $this->name = $name;
        $this->tracks = $tracks;
        $this->duration = 0;
        $this->id = 0; 

        foreach($this->tracks as $arr){
            $this->duration += $arr->durationSec;
        }

    }

    public function __get(string $attr) : mixed{
        if(property_exists($this,$attr)){
            return $this->$attr;
        } else {
            throw new ArgumentException("attribut $attr inexistant");
        }
    }

    public function setID(int $id) : void{
        $this->id = $id;
    }
}